<?php
namespace app\tests;

 require_once __DIR__ .  '../../start.php';
use PDO;
use app\model\User;
use app\config\Database;
use app\helper\Security;
use app\helper\Validation;
use PHPUnit\Framework\TestCase;
use app\controller\RegisterController;

class UserTest extends TestCase
{

    /**
     *
     *@test
     */
    public function UserFieldValidationWithoutName()
    {
        $validation = new Validation();
        $data = ['firstname' => $_POST['firstname'] = ''];

        foreach ($data as $key => $value) {
            $validation->add_error_field($key);
            $this->assertCount(1, $validation->field_errors);
            $this->assertTrue($validation->pass());
        }
    }

    /**
     *
     *@test
     */
    public function UserFieldValidationWithName()
    {
        $validation = new Validation();
        $data = ['firstname' => $_POST['firstname'] = 'fwefwe'];

        foreach ($data as $key => $value) {
            $validation->add_error_field($key);
            $this->assertCount(0, $validation->field_errors);
            $this->assertTrue(!$validation->pass());
        }
    }
}
