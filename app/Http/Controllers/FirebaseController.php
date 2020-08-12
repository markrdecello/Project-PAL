<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Kreait\Firebase;
    use Kreait\Firebase\Factory;
    use Kreait\Firebase\ServiceAccount;
    use Kreait\Firebase\Database;
    class FirebaseController extends Controller
    {
    //
    public function index(){
    $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/project-pal-1-4ac6561f3d0b.json');
    $firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->withDatabaseUri('https://project-pal-1.firebaseio.com/')
    ->create();
    $database = $firebase->createDatabase();
    $newPost = $database
    ->getReference('users')
    ->set([
    'name' => 'Mark',
    'email' => 'md@njcu.edu',
    'password' => '123456',
    'birth_date' => '10/29/1995',
    'school' => 'NJCU',
    'school_id' => '123456',
    'grady_year' => '2021',
    'gender' => 'Male',
    'phone_number' => '201-111-1111',
    'counselor_id' => '123456'
    ]);
    //$newPost->getKey(); // => -KVr5eu8gcTv7_AHb-3-
    //$newPost->getUri(); // => https://my-project.firebaseio.com/blog/posts/-KVr5eu8gcTv7_AHb-3-
    //$newPost->getChild('title')->set('Changed post title');
    $newPost->getValue(); // Fetches the data from the realtime database
    //$newPost->remove();
    echo"<pre>";
    print_r($newPost->getvalue());
    }

    public function getData() {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/project-pal-1-4ac6561f3d0b.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://project-pal-1.firebaseio.com/')
        ->create();

        $database   =   $firebase->getDatabase();
        $createPost    =   $database->getReference('users')->getvalue();      
        return response()->json($createPost);
    }
?>