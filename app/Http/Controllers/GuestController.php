<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller{
    // Get home page
    public function getHomePage(){
    	return view('guest.home', [
            'title' => "PMS::Welcome"
        ]);
    }

    // Get services page
    public function getServicesPage(){
    	return view('guest.services', [
            'title' => "PMS::Our Services"
        ]);
    }

    // Get Contact page
    public function getContactPage(){
    	return view('guest.contact', [
            'title' => "PMS::Contact Us"
        ]);
    }

    // Get Contact page
    public function getAboutPage(){
    	return view('guest.about', [
            'title' => "PMS::About Us"
        ]);
    }
}
