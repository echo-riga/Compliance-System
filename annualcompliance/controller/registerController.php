<?php
    
    include '../config/config.php';
    session_start();
    class controller extends Connection{

        public function managecontroller(){

            if (isset($_POST['register'])) {

                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $middlename = $_POST['middlename'];
                $email = $_POST['email'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $passwordtxt = $_POST['password'];
                $confirmpassword = $_POST['confirmpassword'];
                $employeeid = $_POST['employeeid'];
                $status_of_employment = $_POST['status_of_employment'];
                $fullname = $firstname." ".$lastname;
              //  $type = $_POST['type'];

                $words = [
                    "cloud", "sun", "ocean", "forest", "river",
                    "shadow", "storm", "whisper", "thunder", "flame",
                    "pixel", "drift", "logic", "spark", "echo",
                    "orbit", "ghost", "laser", "raven", "breeze",
                    "frost", "glow", "ember", "crystal", "mist",
                    "stone", "wave", "dust", "nova", "flair",
                    "zenith", "lunar", "void", "pulse", "flux",
                    "shade", "flicker", "prism", "quake", "fury",
                    "chime", "glitch", "radiant", "phantom", "blaze",
                    "shard", "spectrum", "wisp", "signal", "vortex",
                    "haze", "tempo", "cipher", "dusk", "glimmer",
                    "vault", "hollow", "sprint", "venom", "cinder",
                    "phantasm", "mirage", "neon", "plasma", "ignite",
                    "shimmer", "ripple", "rift", "luster", "aurora",
                    "flare", "volt", "saber", "blitz", "drizzle",
                    "myth", "rune", "glyph", "tide", "radiance",
                    "horizon", "infinity", "vibe", "crush", "rumble",
                    "glide", "dawn", "twilight", "zephyr", "whirl",
                    "chroma", "soul", "echoes", "silence", "element",
                    "motion", "quantum", "tremor", "vivid", "gravity", "realm"
                ];

                shuffle($words);
                $passphrase = implode('-', array_slice($words, 0, 12));
                $_SESSION['passphrase'] = $passphrase;


                if ($passwordtxt != $confirmpassword) {

                    echo "<script type='text/javascript'>alert('Password Not Match');</script>";
                    echo "<script>window.location.href='../admin/register.php';</script>";

                } else {

                    $sql = "SELECT * FROM users WHERE email = ?";
                    $stmt = $this->conn()->prepare($sql);
                    $stmt->execute([$email]);

                    if ($stmt->rowcount() > 0) {

                        echo "<script type='text/javascript'>alert('Account Already Exist');</script>";
                        echo "<script>window.location.href='../admin/register.php';</script>";

                    } else {

                        $sql = "INSERT INTO users (employeeid,fullname,firstname,lastname,middlename,email,password,passwordtxt,passphrase,status_of_employment) VALUES (?,?,?,?,?,?,?,?,?,?)";
                        $stmt = $this->conn()->prepare($sql);
                        $stmt->execute([$employeeid,$fullname,$firstname,$lastname,$middlename,$email,$password,$passwordtxt,$passphrase,$status_of_employment]);

                        $sql = "SELECT * FROM users ORDER BY users_id DESC";
                        $stmt = $this->conn()->query($sql);
                        $row = $stmt->fetch();
                        $users_id = $row['users_id'];
                        $fullname = $row['firstname']." ".$row['lastname'];

                        echo "<script type='text/javascript'>alert('Successfully Create Account');</script>";
                        echo "<script>window.location.href='../admin/passphrase.php';</script>";


                    }

                }

                

            }

        }

    }

    $controllerrun = new controller();
    $controllerrun->managecontroller();

?>
