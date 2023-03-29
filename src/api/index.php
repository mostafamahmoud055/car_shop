<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, X-Auth-Token, Accept");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
// This header('Content-Type: application/json');
// OR header("Access-Control-Expose-Headers: Content-Length, X-JSON");
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../../vendor/autoload.php';

try {
    $db = new PDO("mysql:host=localhost;dbname=cars_shop", "root", "",
        [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"]);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}

$app = AppFactory::create();

$app->addBodyParsingMiddleware(); // Parse json, form data and xml // important for post / put / delete => $request->getParsedBody();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Define app routes

$app->get('/', function (Request $request, Response $response) use ($db) {
    $stmt = $db->prepare("SELECT * FROM cars");
    $stmt->execute();
    $response->getBody()->write(json_encode($stmt->fetchAll(PDO::FETCH_ASSOC)));
    return $response;
});
$app->get('/randCars', function (Request $request, Response $response) use ($db) {
    $stmt = $db->prepare("SELECT name, image ,details FROM cars ORDER BY RAND() LIMIT 4");
    $stmt->execute();
    $response->getBody()->write(json_encode($stmt->fetchAll(PDO::FETCH_ASSOC)));
    return $response;
});
$app->delete('/deleteCar/{id}', function (Request $request, Response $response, $args) use ($db) {
    // $data = $request->getParsedBody(); // data that in the body of the delete request
    $id = $args["id"];
    $sql = $db->prepare("SELECT image FROM cars WHERE id=:id");
    $sql->bindParam(':id', $id);
    $sql->execute();
    if (unlink('../../public/assets/img/imgPHP/' . $sql->fetchObject()->image)) {
        $sql = $db->prepare('DELETE FROM cars WHERE id =:id');
        $sql->bindParam(':id', $id);
        $sql->execute();
        $response->getBody()->write("Car is deleted");
        return $response;
    }
});
$app->post('/addCar', function (Request $request, Response $response) use ($db) {
    $data = $request->getParsedBody(); // data that in the body of the post request
    $name = $data["name"];
    $price = $data["price"];
    $modelYear = $data["modelYear"];
    $details = $data["details"];

    $folder = "../../public/assets/img/imgPHP";
    $uploadedFiles = $request->getUploadedFiles();
    $uploadedFile = $uploadedFiles['image'];

    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);

    // see http://php.net/manual/en/function.random-bytes.php
    $basename = bin2hex(random_bytes(8));
    $filename = sprintf('%s.%0.8s', $basename, $extension);

    // handle single input with single file upload

    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
        // insert into db
        $sql = $db->prepare("INSERT INTO cars (`name`,`price`,`modelYear`,`image`,`details`)
        VALUES (:name,:price,:modelYear,:image,:details)");
        $sql->bindParam(':name', $name);
        $sql->bindParam(":price", $price);
        $sql->bindParam(":modelYear", $modelYear);
        $sql->bindParam(":image", $filename);
        $sql->bindParam(":details", $details);

        if ($sql->execute()) {
            $uploadedFile->moveTo($folder . DIRECTORY_SEPARATOR . $filename);
            $response->getBody()->write("New Car Added");
        }

    }

    return $response;
});
$app->post('/updateCar', function (Request $request, Response $response) use ($db) {
    $data = $request->getParsedBody(); // data that in the body of the post request
    $id = $data["id"];
    $name = $data["name"];
    $price = $data["price"];
    $modelYear = $data["modelYear"];
    $oldImage = $data["oldImage"];
    $filename = $data["oldImage"];
    $details = $data["details"];
    $uploadedFiles = $request->getUploadedFiles();
    if ($uploadedFiles) {
        $folder = "../../public/assets/img/imgPHP";
        $uploadedFile = $uploadedFiles['newImage'];
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        // see http://php.net/manual/en/function.random-bytes.php
        $basename = bin2hex(random_bytes(8));
        $filename = sprintf('%s.%0.8s', $basename, $extension);
        $uploadedFile->moveTo($folder . DIRECTORY_SEPARATOR . $filename);
        unlink('../../public/assets/img/imgPHP/' . $oldImage);
    }
    $sql = $db->prepare("UPDATE cars SET name=:name, price=:price, modelYear=:modelYear, image=:image,details=:details WHERE id=:id");
    $sql->bindParam(':id', $id);
    $sql->bindParam(':name', $name);
    $sql->bindParam(":price", $price);
    $sql->bindParam(":modelYear", $modelYear);
    $sql->bindParam(":image", $filename);
    $sql->bindParam(":details", $details);
    if ($sql->execute()) {
        $response->getBody()->write("Car is updated");
        return $response;
    }
});
// Run app
$app->run();
