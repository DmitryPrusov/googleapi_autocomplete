<?php

require_once dirname(__FILE__) . '/autocomplete_search_googleapi.php';

Form_GoogleAPI_Enchant::ajax_handle($_POST['keyword']);

