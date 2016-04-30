<?php

//include_once '../errors/ErrorHandler.php';
//ob_start();
//ini_set('error_reporting', E_NOTICE);
//print_r($_GET['undefined']);

//ob_end_clean();

if (isset ($_REQUEST ['cmd'])) {
    session_start();

    $cmd = $_REQUEST['cmd'];

    switch ($cmd) {
        case 1:
            displaySneakers();
            break;

        case 2:
            customerLogin();
            break;

        case 3:
            checkout();
            break;

        case 8:
            login();
            break;

        case 9:
            wineDetail();
            break;

        case 10:
            shoppingCart();
            break;

        case 11:
            twigLoader();
            break;

        case 12:
            sneakerSearch();
            break;

        case 13:
            validate();
            break;


        default:
            echo '{"result":0,status:"unknown command"}';
            break;
    }//end of switch

}//end of if


function checkout()
{
    if (isset($_SESSION['customer'])) {
        echo 'checkout page';
    } else {
        header('Location: ../controllers/controller.php?cmd=2');
    }
}


function twiggg($url = "", $data = "", $total_sneakers = "", $page = "", /*$totalCost = "", $totalQuantity = "",*/ $total_pages = "")
{
    require_once '../Twig/Autoloader.php';

    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('./templates');
    $twig = new Twig_Environment($loader);

//    print_r($_SESSION['cart']);

//    '/products.html.twig'

    echo $twig->render($url, [
        'sneakers' => $data,
        'totalSneakers' => $total_sneakers,
        'page' => $page,
        'totalPages' => $total_pages,
        /*'carts' => isset($_SESSION['cart']) ? $_SESSION['cart'] : "",
        'totalCost' => $totalCost,
        'totalQuantity' => $totalQuantity,
        'customer' => isset($_SESSION['customer']) ? $_SESSION['customer'] : ''*/
    ]);
}


function customerLogin()
{
    //require_once '../Twig/Autoloader.php';
    include_once '../Sneaker.php';

    if (isset($_POST['username']) && isset($_POST['password'])) {

        $sneaker = new Sneaker();
        $username = $_POST['username'];
        $password = $_POST['password'];
//        echo "$username,$password";

        $result = $sneaker->login($username, $password);
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if (!$row) {
            echo 'Failed to login';
        } else {
            echo '{"result":1, "cust_username":"' . $row['cust_username'] . '"}';
        }
        /*else {
            $_SESSION['customer'] = $row;
            print_r($_SESSION['customer']);
            header('Location: ../controllers/controller.php?cmd=1');
        }
    } elseif (isset($_GET['action']) && $_GET['action'] == 'logout') {
        unset($_SESSION['customer']);
    }

    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('../templates');
    $twig = new Twig_Environment($loader);
    $totalQuantity = 0;

    if (isset($_SESSION['cart'])) {
        $totalCost = 0;

        foreach ($_SESSION['cart'] as $key => $quantity) {

            $totalCost += $_SESSION['cart'][$key]['cost'];
            $totalQuantity += $_SESSION['cart'][$key]['quantity'];
        }
    }


    $url = '/basicView.html.twig';

    /** @var array $row */
        /** @var TYPE_NAME $totalQuantity */
        /*echo $twig->render($url, [
            'customer' => isset($_SESSION['customer']) ? $_SESSION['customer'] : '',
    //        'totalWines' => $total_wines,
    //        'page' => $page,
    //        'totalPages' => $total_pages,
    //        'carts' => isset($_SESSION['cart']) ? $_SESSION['cart'] : "",
    //        'totalCost' => $totalCost,
            'totalQuantity' => $totalQuantity
        ]);*/
    }
}

function twigLoader()
{

    require_once '../vendor/autoload.php';

    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('./templates');
    $twig = new Twig_Environment($loader);


    $limit = 21;
    if (isset($_REQUEST['page'])) {
        $page = $_REQUEST['page'];
    } else {
        $page = 1;
    }

    $offset = ($page - 1) * $limit;

    include_once '../Sneaker.php';
    $sneaker = new Sneaker();
    $result = $sneaker->displaySneakers($limit, $offset);

        $num = $sneaker->countSneaker();
        $total = $num->fetch_assoc();
        $total_sneakers = $total["id"];

        $total_pages = ceil($total_sneakers / $limit);

        $row = $result->fetch_all(MYSQLI_ASSOC);
            $data['allSnakers'] = $row;

    echo $twig->render('product_view.html.twig', [
        'allSneakers' => $row,
        'total_sneakers' => $total_sneakers,
        'total_pages' => $total_pages,
        'page' => $page
    ]);

}
    /** @var array $data */
    /** @var integer $total_wines */
    /** @var integer $total_pages */

  /*  if (isset($_GET['details'])) {
        $url = '/details.html.twig';
    } else {
        $url = '/products.html.twig';
    }

    echo $twig->render($url, [
        'wines' => $data,
        'totalWines' => $total_wines,
        'page' => $page,
        'totalPages' => $total_pages,
        'carts' => isset($_SESSION['cart']) ? $_SESSION['cart'] : "",
        'totalCost' => $totalCost,
        'totalQuantity' => $totalQuantity
    ]);
}
*/

/**
 * Controls the shopping cart
 */
function shoppingCart()
{
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        $sneakerId = intval(isset($_GET['id']) ? $_GET['id'] : 0);

        switch ($action) {
            case 'add':
                if (!isset($_SESSION['cart'][$sneakerId])) {

                    include_once '../Sneaker.php';
                    $cartSneaker = new Sneaker();

                    $result = $cartSneaker->selectSneaker($sneakerId);
                    if ($row = $result->fetch_array(MYSQLI_ASSOC)) {

                        $_SESSION['cart'][$sneakerId] = [
                            'id' => $row['id'],
                            'name' => $row['brand_name'],
                            'cost' => $row['price'],
                            'quantity' => 1,
                        ];
                    }
                } else {
                    echo 'Item already added to cart';
                }
                displaySneakers();
//                twigLoader();
                break;

            case 'change':
                if (isset($_SESSION['cart'][$sneakerId])) {
                    echo $quantity = $_POST['quantity'];

                    include_once '../Sneaker.php';
                    $cartSneaker = new Sneaker();

                    $result = $cartSneaker->selectSneaker($sneakerId);
                    if ($row = $result->fetch_array(MYSQLI_ASSOC)) {

                        if ($quantity < $row['on_hand'] && $quantity > 0) {
                            $_SESSION['cart'][$sneakerId]['quantity'] = $quantity;

                            $_SESSION['cart'][$sneakerId] = [
                                'id' => $row['id'],
                                'name' => $row['brand_name'],
                                'cost' => $row['price'] * $_SESSION['cart'][$sneakerId]['quantity'],
                                'quantity' => $_SESSION['cart'][$sneakerId]['quantity']
                            ];
                        } else {
                            echo 'Available In stock is ' . $row['brand_name'];
                        }

                    } else {
                        echo 'Item does not exist in the database';
                    }
                }
                displaySneakers();
                break;

            case 'increase':
                if (isset($_SESSION['cart'][$sneakerId])) {

                    include_once '../Sneaker.php';
                    $cartSneaker = new Sneaker();

                    $result = $cartSneaker->selectSneaker($sneakerId);
                    if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        $_SESSION['cart'][$sneakerId]['quantity']++;

                        $_SESSION['cart'][$sneakerId] = [
                            'id' => $row['id'],
                            'name' => $row['brand_name'],
                            'cost' => $row['price'] * $_SESSION['cart'][$sneakerId]['quantity'],
                            'quantity' => $_SESSION['cart'][$sneakerId]['quantity']
                        ];
                    } else {
                        echo 'Item does not exist in the database';
                    }
                }
                displaySneakers();
//                twigLoader();
                break;

            case 'decrease':
                if (isset($_SESSION['cart'][$sneakerId]) && intval($_SESSION['cart'][$sneakerId]['quantity']) > 0) {

                    include_once '../Sneaker.php';
                    $cartSneaker = new Sneaker();

                    $result = $cartSneaker->selectSneaker($sneakerId);
                    if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        $_SESSION['cart'][$sneakerId]['quantity']--;

                        $_SESSION['cart'][$sneakerId] = [
                            'id' => $row['id'],
                            'name' => $row['brand_name'],
                            'cost' => $row['price'] * $_SESSION['cart'][$sneakerId]['quantity'],
                            'quantity' => $_SESSION['cart'][$sneakerId]['quantity']
                        ];
                    } else {
                        echo 'Item not in the database';
                    }
                } else {
                    unset($_SESSION['cart'][$sneakerId]);
                }
                displaySneakers();
//                twigLoader();
                break;

            case 'remove':
                if (isset($_SESSION['cart'][$sneakerId])) {
                    unset($_SESSION['cart'][$sneakerId]);
                }
                displaySneakers();
//                twigLoader();
                break;

            case 'empty':
                unset($_SESSION['cart']);
                displaySneakers();
//                twigLoader();
                break;

            default:
                displaySneakers();
//                twigLoader();
                break;
        }
    }
}


/**
 * Function to display all wines
 */
function displaySneakers()
{

    /*$num_perPage = 21;
    if (isset($_REQUEST['page'])) {
        $page = $_REQUEST['page'];
    } else {
        $page = 1;
    }

    $start_from = ($page - 1) * $num_perPage;

    include_once '../models/Sneaker.php';
    $sneaker = new Sneaker();

    if ($result = $sneaker->displaySneakers($start_from, $num_perPage)) {

        $num = $sneaker->countSneaker();
        $total = $num->fetch_assoc();
        $total_sneakers = $total["id"];

        $total_pages = ceil($total_sneakers / $num_perPage);

        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $data[] = $row;
        }
    }

    $totalCost = 0;
    $totalQuantity = 0;

   /* $sneaker_id = intval(isset($_GET['id']) ? $_GET['id'] : 0);*/

   /* if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $quantity) {
            $totalCost += $_SESSION['cart'][$key]['cost'];
            $totalQuantity += $_SESSION['cart'][$key]['quantity'];
        }
    }*/

    /** @var TYPE_NAME $data */
    /** @var TYPE_NAME $total_wines */
    /** @var TYPE_NAME $total_pages */
  /*  twiggg('/products.html.twig', $data, $total_wines, $page, $totalCost, $totalQuantity, $total_pages);*/
}


/**
 * Function to display all wines
 */
/*function wineDetail()
{

    if (isset($_GET['wine_id'])) {
        include_once '../models/Wine.php';

        $wine_id = $_GET['wine_id'];
        $wine = new Wine();

        if ($result = $wine->wineDetail($wine_id)) {
            $row = $result->fetch_assoc();

            twiggg('/details.html.twig', $row);
        }
    }
}


/**
 * Function to search.twig.twig for a task
 */
function sneakerSearch()
{

    if (isset ($_REQUEST ['searchWord'])) {
        include_once '../Sneaker.php';
        $sneaker = new Sneaker ();

        $searchWord = $_REQUEST ['searchWord'];

        if ($result = $sneaker->search($searchWord)) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            echo '{"result":1, "sneakers": [';
            while ($row) {
                echo '{"sneaker_id": "' . $row ["id"] . '", "brand_name": "' . $row ["brand_name"] . '",
            "sneaker_size": "' . $row ["size"] . '", "color": "' . $row ["color"] . '",
            "price": "' . $row["price"] . '"}';

                if ($row = $result->fetch_all(MYSQLI_ASSOC)) {
                    echo ',';
                }
            }
            echo ']}';
        } else {
            echo '{"result":0,"status": "An error occurred for select product."}';
        }
    }
}//end of search_task()


/**
 * Function to display all tasks
 */
/*function displayWineTypes()
{
    include_once '../models/Wine.php';
    $wine = new Wine ();

    if ($result = $wine->wineType()) {
        $row = $result->fetch_assoc();
        echo '{"result":1, "wineType": [';
        while ($row) {
            echo '{"wine_type_id": "' . $row ["wine_type_id"] . '", "wine_type": "' . $row ["wine_type"] . '"}';

            if ($row = $result->fetch_assoc()) {
                echo ',';
            }
        }
        echo ']}';
    } else {
        echo '{"result":0,"status": "An error occurred for display wines."}';
    }
}


/**
 * Function to display all tasks
 */
/*function displayWineByType()
{
    if (isset ($_REQUEST ['wineType'])) {
        include_once '../models/Wine.php';
        $wine = new Wine ();

        $wineType = $_REQUEST ['wineType'];

        if ($result = $wine->displayWineByType($wineType)) {
            $row = $result->fetch_assoc();
            echo '{"result":1, "wines": [';
            while ($row) {
                echo '{"wine_id": "' . $row ["wine_id"] . '", "wine_name": "' . $row ["wine_name"] . '",
            "winery_name": "' . $row ["winery_name"] . '", "cost": "' . $row ["cost"] . '",
            "wine_type": "' . $row["wine_type"] . '", "year": "' . $row["year"] . '"}';

                if ($row = $result->fetch_assoc()) {
                    echo ',';
                }
            }
            echo ']}';
        } else {
            echo '{"result":0,"status": "An error occurred for display wines."}';
        }
    }
}//end of display_all_tasks()


/**
 * Function to display all sorted wines by cost in
 * descending order
 */
/*function sortWineDesc()
{
    include_once '../models/Wine.php';
    $wine = new Wine ();

    if ($result = $wine->sortWinePriceDesc()) {
        $row = $result->fetch_assoc();
        echo '{"result":1, "sortWines": [';

        while ($row) {
            echo '{"wine_id": "' . $row ["wine_id"] . '", "wine_name": "' . $row ["wine_name"] . '",
            "winery_name": "' . $row ["winery_name"] . '", "cost": "' . $row ["cost"] . '",
            "wine_type": "' . $row["wine_type"] . '", "year": "' . $row["year"] . '"}';

            if ($row = $result->fetch_assoc()) {
                echo ',';
            }
        }
        echo ']}';
    } else {
        echo '{"result":0,"status": "An error occurred for display wines."}';
    }
}*/

function validate()
{

    include_once '../Sneaker.php';
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $sneaker = new Sneaker();

        $username = $_POST['username'];
        $password = $_POST['password'];


        $result = $sneaker->login($username, $password);
        if (!$result) {
            echo '{"result":0,"message":"Failed to Login "}';
            return;
        } else {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if (empty($row)) {
                echo '{"result":0,"message":"Login Failed, Invalid password or username"}';
                return;
            } else if (!empty($row)) {
                // $checked=$row['checked'];
                // if($checked==1){
                echo '{"result":1,"message":"Authentic User"}';
                return;
                // }
                // else if($checked==100){
                // 	echo '{"result":2,"message":"Have to Change Password"}';
                // 	return;
                // }
                // else{
                // 	echo '{"result":0,"message":"Invalid User Account"}';
                // 	return;
                // }
            }

        }
    }
}

/**
 * Function to display all sorted wines by cost in
 * ascending order
 */
/*function sortWineAsc()
{
    include_once '../models/Wine.php';
    $wine = new Wine ();

    if ($result = $wine->sortWinePriceAsc()) {
        $row = $result->fetch_assoc();
        echo '{"result":1, "sortWines": [';

        while ($row) {
            echo '{"wine_id": "' . $row ["wine_id"] . '", "wine_name": "' . $row ["wine_name"] . '",
            "winery_name": "' . $row ["winery_name"] . '", "cost": "' . $row ["cost"] . '",
            "wine_type": "' . $row["wine_type"] . '", "year": "' . $row["year"] . '"}';

            if ($row = $result->fetch_assoc()) {
                echo ',';
            }
        }
        echo ']}';
    } else {
        echo '{"result":0,"status": "An error occurred for display wines."}';
    }
}


/**
 * Function to display all sorted wines by name
 */
/*function sortWineName()
{
    include_once '../models/Wine.php';
    $wine = new Wine ();

    if ($result = $wine->sortWineName()) {
        $row = $result->fetch_assoc();
        echo '{"result":1, "sortWines": [';

        while ($row) {
            echo '{"wine_id": "' . $row ["wine_id"] . '", "wine_name": "' . $row ["wine_name"] . '",
            "winery_name": "' . $row ["winery_name"] . '", "cost": "' . $row ["cost"] . '",
            "wine_type": "' . $row["wine_type"] . '", "year": "' . $row["year"] . '"}';

            if ($row = $result->fetch_assoc()) {
                echo ',';
            }
        }
        echo ']}';
    } else {
        echo '{"result":0,"status": "An error occurred for display wines."}';
    }
}
*/
function login()
{
    if (isset ($_REQUEST['username']) & isset ($_REQUEST['password'])) {
        include_once '../Sneaker.php';
        $obj = new Sneaker ();
        $username = stripslashes($_REQUEST ['username']);
        $password = stripslashes($_REQUEST ['password']);

        $result = $obj->login($username, $password);
        $row = $result->fetch_all();

        if (!$row) {
            echo '{"result":0, "message":"Failed to login"}';
        } else {
            echo '{"result":1, "user_name":"' . $row['cust_username'] . '"}';
        }

        $result->close();
    }

}


/*function sendMail()
{
    $admin = "chok.real@gmail.com";
    $mail = "fredrick.abayie@ashesi.edu.gh";
    $subject = "Mail sending first test";
    $comment = "good or bad";

    if (mail($admin, $subject, $comment, 'From' . $mail)) {
        echo '{"success"}';
    }
}*/