<?php 
error_reporting(E_ALL);





require_once "orm/DBManager.php";
DBManager::getManager() -> connect();

$_POST = json_decode(file_get_contents('php://input'),true);

$path = array();
if(isset($_SERVER['PATH_INFO'])) {
$path = explode('/',$_SERVER['PATH_INFO']);
array_shift($path);
}



$err = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //company registration
    if($_POST["type"] == "company"){
      $company = cleanInput($_POST["company"]);
      if($company=="") {
        $err .= "<br />Error -- company name not found";
        $company = null;
      }

      $shortname = cleanInput($_POST["shortname"]);
      if($shortname=="") {
        $shortname = $company;
      }


      $email = cleanInput($_POST["email"]);
      if($email==""){
        $err .="<br />Error -- email not found";
        $email = null;
      }

      $country = cleanInput($_POST["country"]);
      if($country==""){
        $err .= "<br />Error -- country not found";
        $country = null;
      }

      $state = cleanInput($_POST["state"]);
      if($state==""){
        $err .= "<br />Error -- state not found";
        $state = null;
      }
        
      $city = cleanInput($_POST["city"]);
      if($city==""){
        $err .= "<br />Error -- city not found";
        $city = null;
      }
        
      $website = cleanInput($_POST["website"]);
      if($website==""){
        $err .= "<br />Error -- website not found";
        $website = null;
      }
    
            
      $password = cleanInput($_POST["password"]);
      if($password==""){
        $err .= "<br />Error -- password not found";
        $password = null;
      }
        
      $confirm_password = cleanInput($_POST["confirm_password"]);
      if($confirm_password==""){
        $err .= "<br />Error -- confirm password not found";
        $confirm_password = null;
      }
      
      if(!($password === $confirm_password)){
        $err .= "<br />Error -- passwords do not match";
        $password = null; //Must have this so that in case of update, a null password (which is required for update) prevents update if the two don't match
      }

      
      if($err=="" && !isset($_POST["id"])){
        require_once "orm/Account.php";
        $id = Account::create('company') -> getId();
        require_once "orm/Company.php";
        Company::create($id, $company, $shortname, $city, $country, $state, $website);
        require_once "orm/Login.php";
        Login::create($id,$email,$password);
        echo "Your company: " . $company . " was created";
      }
      else if(isset($_POST["id"])){
        $id = $_POST["id"];
        require_once "orm/Company.php";
        Company::update($id,$company,$shortname,$city,$country,$state,$website);
        require_once "orm/Login.php";
        Login::update($id,$email,$password);
        echo "Your company was updated";
      } else {
        if(!($err==""))
          echo $err;

      }


    }
    
    //Student registration
    else if($_POST["type"] == "student"){
    
      $first_name = cleanInput($_POST["first_name"]);
      if($first_name=="")
        $err .= "<br />Error -- first name not found";
        
      $last_name = cleanInput($_POST["last_name"]);
      if($last_name=="")
        $err .= "<br />Error -- last name not found";
        
      $email = cleanInput($_POST["email"]);
      if($email==""){
        $err .="<br />Error -- email not found";
      }
      
      $major = cleanInput($_POST["major"]);
      if($major=="")
        $err .= "<br />Error -- major not found";
        
      $school = cleanInput($_POST["school"]);
      if($school=="")
        $err .= "<br />Error -- school name not found";
        
      $year = cleanInput($_POST["year"]);
      if($year=="")
        $err .= "<br />Error -- year not found";
        
      $password = cleanInput($_POST["password"]);
      if($password=="")
        $err .= "<br />Error -- password not found";
        
      $confirm_password = cleanInput($_POST["confirm_password"]);
      if($confirm_password=="")
        $err .= "<br />Error -- confirm password not found";
      
      if(!($password === $confirm_password))
        $err .= "<br />Error -- passwords do not match";
      
      if($err=="" && !isset($_POST["id"])){
        require_once "orm/Account.php";
        $id = Account::create('student') -> getId();
        require_once "orm/Student.php";
        Student::create($id, -1, $first_name, $last_name, $year);
        require_once "orm/Login.php";
        Login::create($id,$email,$password);
        echo "Thanks, " . $first_name . ", your account has been created";
      } else if(isset($_POST["id"]) && isset($password)){
        $id = $_POST["id"];
        require_once "orm/Student.php";
        Student::update($id,null,$first_name,$last_name,$year);
        require_once "orm/Login.php";
        Login::update($id,$email,$password);


      } else {
        if(!($err==""))
          echo $err;

      }

      
    }
    else { //Post with incorrect type
      $err = "<br />Error -- type (student or company) incorrect";
    }
    
} else if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if(isset($_GET["delete"])){
      if(isset($_GET["id"])){
        require_once "orm/Account.php";
        Account::delete($_GET["id"]);
        require_once "orm/Student.php";
        Student::delete($_GET["id"]);
        require_once "orm/Company.php";
        Company::delete($_GET["id"]);
        require_once "orm/Login.php";
        Login::delete($_GET["id"]);
        echo "deleted";
        
      }
      else {
        echo "<br /> Cannot delete--id not specified";
      }
    } else
    if($path[0] =="students") {
      if(isset($_GET["id"])){
        require_once "orm/Student.php";
        $student = Student::get($_GET["id"],null,null,null,null)[0];
        $arr = array('first_name' => $student->getFirst(), 'last_name' => $student->getLast(), 'year' => $student->getYear());
        echo json_encode($arr);
      }
      else{
        require_once "orm/Student.php";
        $list = Student::get(null,null,null,null,null);
        $returnarray;
        foreach ($list as $student){
          $arr = array('id' => $student->getId(), 'first_name' => $student->getFirst(), 'last_name' => $student->getLast(), 'year' => $student->getYear());
          $returnarray[] = $arr;
        }
        echo json_encode($returnarray);
      }
    }
    else if($path[0] == "companies") {
      if(isset($_GET["id"])){
        require_once "orm/Company.php";
        $company = Company::get($_GET["id"],null,null,null,null,null,null)[0];
        $arr = array('companyName' => $company->getName(), 'shortname' => $company->getShortName(), 'city' => $company->getCity(), 'state' => $company->getState(), 'country' => $company->getCountry(), 'website' => $company->getWebsite());
        echo json_encode($arr);
      }
      else {
        require_once "orm/Company.php";
        $list = Company::get(null,null,null,null,null,null,null);
        $returnarray;
        foreach ($list as $company){
          $arr = array('id' => $company->getId(), 'companyName' => $company->getName(), 'shortname' => $company->getShortName(), 'city' => $company->getCity(), 'state' => $company->getState(), 'country' => $company->getCountry(), 'website' => $company->getWebsite());
          $returnarray[] = $arr;
        }
        echo json_encode($returnarray);
      }
    }
    else {
        require_once "orm/Account.php";
        if(Account::get($path[0], null)[0]->getType() == "student"){
          require_once "orm/Student.php";
          $student = Student::get($path[0],null,null,null,null)[0];
          $arr = array('first_name' => $student->getFirst(), 'last_name' => $student->getLast(), 'year' => $student->getYear());
          echo json_encode($arr);
        } else {
          require_once "orm/Company.php";
          $company = Company::get($path[0],null,null,null,null,null,null)[0];
          $arr = array('companyName' => $company->getName(), 'shortname' => $company->getShortName(), 'city' => $company->getCity(), 'state' => $company->getState(), 'country' => $company->getCountry(), 'website' => $company->getWebsite());
          echo json_encode($arr);

        }
    }

}
function cleanInput($input){
    
    $input = trim($input);
    $input = strip_tags($input);
    return $input;
}

?>