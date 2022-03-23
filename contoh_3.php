<?php
  
// Deklarasi class parent
abstract class bank {
    protected  $name;
   
    public function __construct( $name) {
        $this->name = $name;
    }
   
    abstract public function account();

    public function acc_no(account_no $n) {
        echo $this->name . " has " . get_class($n);
    }
}
  
// Child 1
class SBI extends bank {
    public function account() {
        echo $this->name . " has an SBI account";
    }

    // Fungsi acc_no dioverride di dalam 
    // class SBI yang memungkinkan semua tipe 
    // object account_detail, hal tersebut menunjukkan
    // behaviour contravariance
    public function acc_no(account_detail $n) {
        echo $this->name . " has an SBI "
                . get_class($n);
    }
}
  
// Child2
class BOI extends bank {
    public function account() {
        echo $this->name . " has a BOI account";
    }
}
  
interface acc_open {
    public function open($name): bank;
}
   
class SBI_acc_open implements acc_open {
      
    // Tidak melakukan return pada class 
    // bertipe parent alih-alih dilakukan
    // pada class bertipe child
    public function open($name): SBI {
        return new SBI($name);
    }
}
   
class BOI_acc_open implements acc_open {
      
    // Tidak melakukan return pada class 
    // bertipe parent alih-alih dilakukan
    // pada class bertipe child
    public function open( $name) : BOI {
        return new BOI($name);
    }
}
   
class account_detail{} 
class account_no extends account_detail{}

$a = (new SBI_acc_open)->open("Harvey");
$a->account();
echo "\n";
$d = new account_detail();
$a->acc_no($d);
echo "\n";
   
$b = (new BOI_acc_open)->open("Simon");
$b->account();
echo "\n";
$c = new account_no();
$b->acc_no($c);
?>