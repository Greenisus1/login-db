$loader = new FilesystemLoader(__DIR__ . '/templates');
 $twig = new Environment($loader);

 // Configure WorkOS with API Key and Client ID 
 // Configure WorkOS with API Key and Client ID
 \WorkOS\WorkOS::setApiKey($WORKOS_API_KEY);
 \WorkOS\WorkOS::setClientId($WORKOS_CLIENT_ID);

 @@ -26,8 +26,7 @@
 // Convenient function for redirecting to  URL
 function Redirect($url, $permanent = false)
 {
     if (headers_sent() === false)
     {
     if (headers_sent() === false) {
         header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
     }

 @@ -36,17 +35,17 @@ function Redirect($url, $permanent = false)

 // Routing
 switch (strtok($_SERVER["REQUEST_URI"], "?")) {
     case (preg_match("/\.css$/", $_SERVER["REQUEST_URI"]) ? true: false): 
     case (preg_match("/\.css$/", $_SERVER["REQUEST_URI"]) ? true : false):
         $path = __DIR__ . "/static/css" .$_SERVER["REQUEST_URI"];
         if (is_file($path)) {
            // header("Content-Type: text/css");
             // header("Content-Type: text/css");
             header("Content-Type: image/png");
             readfile($path);
             return true;
         }
         return httpNotFound();

     case (preg_match("/\.png$/", $_SERVER["REQUEST_URI"]) ? true: false): 
     case (preg_match("/\.png$/", $_SERVER["REQUEST_URI"]) ? true : false):
         $path = __DIR__ . "/static/images" .$_SERVER["REQUEST_URI"];
         if (is_file($path)) {
             header("Content-Type: image/png");
 @@ -55,24 +54,24 @@ function Redirect($url, $permanent = false)
         }
         return httpNotFound();

     //Declare main and /login routes which renders templates/generate.html
         //Declare main and /login routes which renders templates/generate.html
     case ("/"):
         echo $twig->render("generate.html");
         return true; 
         return true;

     case ("/callback"):
         $code = $_GET["code"];
         

         $profileAndToken = (new \WorkOS\SSO())->getProfileAndToken($code);

         // Use the information in `profile` for further business logic.
         $profile = json_encode($profileAndToken->profile);
         echo $twig->render("success.html", ['profile' => $profile]);
         return true;
  

     case ("/passwordless-auth"):
         // Email of the user to authenticate
         

         $email = $_POST["email"];
         $passwordless = new \WorkOS\Passwordless();

 @@ -91,7 +90,8 @@ function Redirect($url, $permanent = false)
         $link = $session->link;
         echo $twig->render("email-sent.html", ['link' => $link, 'email' => $email]);

     // all other routes don't return anything
         // all other routes don't return anything
         // no break
     default:
         return true;
 }
 }
