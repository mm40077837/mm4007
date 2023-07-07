<?php
trait SendsPasswordResetEmails {

    

public function showLinkRequestForm()
{
    return view('auth.passwords.email');
}


}
?>