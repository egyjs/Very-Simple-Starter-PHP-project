<?php
if (is_login()){
    logout();
    to('/');
}
