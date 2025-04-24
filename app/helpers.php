<?php

use App\Models\Company;

// ! tambahin file ini ke composer.json di autoload agar bisa di load
if (!function_exists('getCompany')) {
  function getCompany()
  {
    return Company::findOrFail(session('company_id'));
  }
}
