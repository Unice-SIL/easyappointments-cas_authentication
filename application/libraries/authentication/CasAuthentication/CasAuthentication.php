<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - Open Source Web Scheduler
 *
 * @package     EasyAppointments
 * @author      F.Casazza <frederic.casazza@unice.fr>
 * ---------------------------------------------------------------------------- */

defined('BASEPATH') OR exit('No direct script access allowed');

Class CasAuthentication implements AuthenticationInterface
{

    protected $CI;
    protected $cas_version;
    protected $cas_host;
    protected $cas_port;
    protected $cas_context;
    protected $cas_service_redirect;
    protected $cas_cert;
    protected $cas_no_server_validation;
    protected $cas_debug;
    protected $cas_verbose;

    /**
     * Authentication constructor.
     */
    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
        $this->CI->load->file(__DIR__.DIRECTORY_SEPARATOR.'phpCAS/CAS.php');
        $this->cas_version = defined('Config::CAS_VERSION')? Config::CAS_VERSION : '2.0';
        $this->cas_host = defined('Config::CAS_HOST')? Config::CAS_HOST : '';
        $this->cas_port = defined('Config::CAS_PORT')? Config::CAS_PORT : 80;
        $this->cas_context = defined('Config::CAS_CONTEXT')? Config::CAS_CONTEXT : '';
        $this->cas_service_redirect = defined('Config::CAS_SERVICE_REDIRECT_URL')? Config::CAS_SERVICE_REDIRECT_URL : '';
        $this->cas_cert = defined('Config::CAS_CERT')? Config::CAS_CERT : '';
        $this->cas_no_server_validation = defined('Config::CAS_NO_SERVER_VALIDATION')? Config::CAS_NO_SERVER_VALIDATION : FALSE;
        $this->cas_debug = defined('Config::CAS_DEBUG')? Config::CAS_DEBUG : FALSE;
        $this->cas_verbose = defined('Config::CAS_VERBOSE')? Config::CAS_VERBOSE : FALSE;
        if($this->cas_debug) phpCAS::setDebug();
        if($this->cas_verbose) phpCAS::setVerbose(true);
        phpCAS::client($this->cas_version, $this->cas_host, $this->cas_port, $this->cas_context, FALSE);
        if(!empty($this->cas_service_redirect)) phpCAS::setFixedServiceURL($this->cas_service_redirect);
        if($this->cas_no_server_validation) phpCAS::setNoCasServerValidation();
        if(!empty($this->cas_cert)) phpCAS::setCasServerCACert($this->cas_cert);
        phpCAS::setNoClearTicketsFromUrl();
    }

    public function login()
    {

        phpCAS::forceAuthentication();
        return phpCAS::getUser();
    }

    public function logout()
    {
        phpCAS::logout();
    }

    public function on_authentication_failure()
    {
        return FALSE;
    }

    public function on_authentication_success()
    {
        header('Location: ' . $this->CI->session->userdata('dest_url'));
    }
}