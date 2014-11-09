<?php define("SMS_CONTROLER_URL", DIR_APPLICATION . 'model/sms/'); require_once (defined("SMS_CONTROLER_URL")?SMS_CONTROLER_URL:"") .'smsController.php'; define("MAX_ROWS", 70); class ControllerSmsHistory extends SmsController { public $year; public $month; public $day; public $eshopsms = 1; public $bulksms = 1; public $bulksms2 = 1; public $eshopsms1 = 1; public $status; public $filter; public function index() { $this->defaultValueDefine("year", date("Y")); $this->defaultValueDefine("month", date("m")); parent::index(); } public function ajaxReload($ib1199182837e705aae8d93f525c88b1184f9395d) { $this->defaultValueDefine("year", date("Y")); $this->defaultValueDefine("month", date("m")); $this->disableScrollUp(); $i83d1339527a9dc91b02fa99420eb13b0cd47adfe = $this->Execute("SELECT ID FROM `".DB_PREFIX."sp_sms_history` WHERE `change` = 1 ORDER BY `ID` DESC LIMIT 1"); if($i83d1339527a9dc91b02fa99420eb13b0cd47adfe->num_rows) { $this->sendSnippet("output", $this->f7aa65fb1ca97cc2b8a4c81af998d7d5d224d8620()); } } public function display() { $i02fcabda2448d40bdb76bd10f9e95950039649ee = parent::display(); $i02fcabda2448d40bdb76bd10f9e95950039649ee .= "<script type=\"text/javascript\" src=\"" . DIR_SMS_JS . "sms.js\"></script>"; $i02fcabda2448d40bdb76bd10f9e95950039649ee .= '<div id="snippet-output">'.$this->f7aa65fb1ca97cc2b8a4c81af998d7d5d224d8620().'</div>'; if(count($_POST) == 0 && !isset($_GET["filter"]) && !isset($_GET["ps"])) { $i02fcabda2448d40bdb76bd10f9e95950039649ee .= '<script type="text/javascript"> setInterval( function() { jQuery.getJSON("'.$this->smsLinkHistoryReload().'"); } ,10000); </script>'; } return $i02fcabda2448d40bdb76bd10f9e95950039649ee; } public function postProcess($if7ac7ffb0e11bffa95681698138e923b4fd51990 = NULL, $i120dfeb2f4db76e8e52ed01ad8e678e2b9fa3bb9 = NULL, $i4df8c509b6936a0640c1594ca9b38a0a55a9562f = NULL) { if($if7ac7ffb0e11bffa95681698138e923b4fd51990 == NULL && $i120dfeb2f4db76e8e52ed01ad8e678e2b9fa3bb9 == NULL) { return self::POST_ERROR; } if(isset($i4df8c509b6936a0640c1594ca9b38a0a55a9562f['submitSmsHistory'])) { $if7ac7ffb0e11bffa95681698138e923b4fd51990 = $this->escapeInput($if7ac7ffb0e11bffa95681698138e923b4fd51990); unset($if7ac7ffb0e11bffa95681698138e923b4fd51990["submitSmsHistory"]); $this->f00209a13a49aae3cb70a784535c6e4d60b0f7a12($if7ac7ffb0e11bffa95681698138e923b4fd51990); $this->filter = base64_encode(serialize($if7ac7ffb0e11bffa95681698138e923b4fd51990)); } return self::POST_ERROR; } private static function premadeDate($i2c0ef3bef9410f3bf64e2871a1e4a7bb4dbc7f69) { if($i2c0ef3bef9410f3bf64e2871a1e4a7bb4dbc7f69 == -1) { $i6e265112d3f62d8b9a6c1ab7809806b07dd801ad = "%"; } elseif(strlen($i2c0ef3bef9410f3bf64e2871a1e4a7bb4dbc7f69) == 1) { $i6e265112d3f62d8b9a6c1ab7809806b07dd801ad = "0" . $i2c0ef3bef9410f3bf64e2871a1e4a7bb4dbc7f69; } else { $i6e265112d3f62d8b9a6c1ab7809806b07dd801ad = $i2c0ef3bef9410f3bf64e2871a1e4a7bb4dbc7f69; } return $i6e265112d3f62d8b9a6c1ab7809806b07dd801ad; } private function f50fd73a826539c3515099ad606f8e83a2fab7d52($ib1199182837e705aae8d93f525c88b1184f9395d) { $this->filter = $_GET["filter"]; $id6df7fb626ea7dcb74a3aeaed55471bda0715fc1 = unserialize(base64_decode($ib1199182837e705aae8d93f525c88b1184f9395d)); $this->f00209a13a49aae3cb70a784535c6e4d60b0f7a12($id6df7fb626ea7dcb74a3aeaed55471bda0715fc1); } private function f00209a13a49aae3cb70a784535c6e4d60b0f7a12($id6df7fb626ea7dcb74a3aeaed55471bda0715fc1) { $this->year = $id6df7fb626ea7dcb74a3aeaed55471bda0715fc1["year"]; $this->month = $id6df7fb626ea7dcb74a3aeaed55471bda0715fc1["month"]; $this->day = $id6df7fb626ea7dcb74a3aeaed55471bda0715fc1["day"]; $this->eshopsms = (isset($id6df7fb626ea7dcb74a3aeaed55471bda0715fc1["eshopsms"])) ? 1 : 0; $this->bulksms = (isset($id6df7fb626ea7dcb74a3aeaed55471bda0715fc1["bulksms"])) ? 1 : 0; $this->bulksms2 = (isset($id6df7fb626ea7dcb74a3aeaed55471bda0715fc1["bulksms2"])) ? 1 : 0; $this->eshopsms1 = (isset($id6df7fb626ea7dcb74a3aeaed55471bda0715fc1["eshopsms1"])) ? 1 : 0; $this->status = $id6df7fb626ea7dcb74a3aeaed55471bda0715fc1["status"]; } private function f7aa65fb1ca97cc2b8a4c81af998d7d5d224d8620() { $i02fcabda2448d40bdb76bd10f9e95950039649ee = ""; $this->Execute("UPDATE `".DB_PREFIX."sp_sms_history` SET `change`= 0;"); if(isset($_GET["filter"]) && $_GET["filter"] != "" && $this->filter == null) { $this->f50fd73a826539c3515099ad606f8e83a2fab7d52($_GET["filter"]); } $i7fb9e90bc870bb7152647e673ad3beb8d1ae1a74 = array(0 => v_smshistory_status, SmsModel::STATUS_SENT => v_smshistory_sent, SmsModel::STATUS_ERROR => v_smshistory_error, SmsModel::STATUS_DELIVERED => v_smshistory_delivered, SmsModel::STATUS_BUFFERED => v_smshistory_buffered, SmsModel::STATUS_SIMULATION => v_smshistory_simulation, SmsModel::STATUS_SHEDULED => v_smshistory_sheduled, SmsModel::STATUS_DELETED => v_smshistory_deleted, SmsModel::STATUS_DND => v_smshistory_dnd, SmsModel::STATUS_DUPLICATE => v_smshistory_duplicate); $i3f7c957cf91980835868755b4522fdafe03da70f = array(SmsModel::STATUS_SENT => self::$sendImg, SmsModel::STATUS_ERROR => self::$denyImg, SmsModel::STATUS_DELIVERED => self::$acceptImg, SmsModel::STATUS_BUFFERED => self::$bufferedImg, SmsModel::STATUS_SIMULATION => self::$simulationImg, SmsModel::STATUS_SHEDULED => self::$calendarImg, SmsModel::STATUS_DELETED => self::$adminDelete, SmsModel::STATUS_DND => self::$doNotDisturbImg, SmsModel::STATUS_DUPLICATE => self::$duplicateImg); $i8d0bfc4e5c6ec343168005e262411ae0e2a293cb = array(SmsModel::TYPE_ADMIN => v_smshistory_adminsms, SmsModel::TYPE_CUSTOMERS => v_smshistory_customersms, SmsModel::TYPE_MARKETING => v_smshistory_marketingsms, SmsModel::TYPE_SIMPLE => v_smshistory_simplesms); $i50fa9bd77200446bffa598146260f67a8d3c8aac = array(0 => v_smshistory_no, 1 => v_smshistory_yes); $i02fcabda2448d40bdb76bd10f9e95950039649ee .= ' <h2>' . v_smshistory_smshistory .'</h2><p>' . v_smshistory_description . '</p> <fieldset> <legend><img src="' . self::$setingsImg . '" alt="' . v_smshistory_smshistory . '" /> ' . v_smshistory_smshistory . '</legend> <form action="" method="post"> <table> <tbody> <tr> <td>' . self::getSelect(array("name" => "year"), self::generateNumbers(2013, date("Y"), false, v_smshistory_year, 0), $this->year) . '</td> <td>' . self::getSelect(array("name" => "month"), self::generateNumbers(1, 12, false, v_smshistory_month, -1), $this->month) . '</td> <td>' . self::getSelect(array("name" => "day"), self::generateNumbers(1, 31, false, v_statistics_day, -1), $this->day) . '</td> <td>' . self::getSelect(array("name" => "status"), $i7fb9e90bc870bb7152647e673ad3beb8d1ae1a74, $this->status) . '</td> <td>' . self::getInput(array("type" => "checkbox", "name" => "eshopsms1", "value" => 1), $this->eshopsms1) . ' ' . v_smshistory_adminsms . '</td> <td>' . self::getInput(array("type" => "checkbox", "name" => "eshopsms", "value" => 1), $this->eshopsms) . ' ' . v_smshistory_customersms . '</td> <td>' . self::getInput(array("type" => "checkbox", "name" => "bulksms", "value" => 1), $this->bulksms) . ' ' . v_smshistory_marketingsms . '</td> <td>' . self::getInput(array("type" => "checkbox", "name" => "bulksms2", "value" => 1), $this->bulksms2) . ' ' . v_smshistory_simplesms . '</td> <td>' . self::getInput(array("type" => "submit", "name" => "submitSmsHistory", "value" => v_smshistory_show, "class" => "button")) . '</td> </tr> </tbody> </table> </form> </fieldset> '; $i1fbf168554af8321251bea1aaa006905d8289ef0 = $this->escape(self::premadeDate($this->month)); $id7ef2028874d93a030affa6848b8e12829ea18a9 = $this->escape(self::premadeDate($this->day)); $i82b103019f8b63abe35e23c8982897d7b3b13cd2 = array(); if($this->eshopsms == 1) { $i82b103019f8b63abe35e23c8982897d7b3b13cd2[] = 2; } if($this->eshopsms1 == 1) { $i82b103019f8b63abe35e23c8982897d7b3b13cd2[] = 1; } if($this->bulksms == 1) { $i82b103019f8b63abe35e23c8982897d7b3b13cd2[] = 3; } if($this->bulksms2 == 1) { $i82b103019f8b63abe35e23c8982897d7b3b13cd2[] = 4; } if(count($i82b103019f8b63abe35e23c8982897d7b3b13cd2) > 0) { $ibf21559a5865d0706b08586780050d04efc951d3 = " AND " . DB_PREFIX . "sp_sms_history.type IN (" . implode(",", $i82b103019f8b63abe35e23c8982897d7b3b13cd2) . ")"; } else { $ibf21559a5865d0706b08586780050d04efc951d3 = ""; } if($this->status > 0) { $i088e5493da345fd9a50093a74c3f1d122db69ddd = " AND " . DB_PREFIX . "sp_sms_history.status=" . $this->escape($this->status); } else { $i088e5493da345fd9a50093a74c3f1d122db69ddd = ""; } if(!$this->year) { $this->year = "%"; } $i7bb23f2129d71956fd95288eaa834df71e09419e = $this->year . "-" . $i1fbf168554af8321251bea1aaa006905d8289ef0 . "-" . $id7ef2028874d93a030affa6848b8e12829ea18a9 . "%"; $ife90ec3ee83cd90f9098beed08a011650ddba7e7 = "SELECT count(*) AS count FROM " . DB_PREFIX . "sp_sms_history WHERE date LIKE '" . $i7bb23f2129d71956fd95288eaa834df71e09419e . "'" . $ibf21559a5865d0706b08586780050d04efc951d3 . "" . $i088e5493da345fd9a50093a74c3f1d122db69ddd . ""; $i83d1339527a9dc91b02fa99420eb13b0cd47adfe = $this->Execute($ife90ec3ee83cd90f9098beed08a011650ddba7e7); if($i83d1339527a9dc91b02fa99420eb13b0cd47adfe->num_rows) { foreach($i83d1339527a9dc91b02fa99420eb13b0cd47adfe->rows as $i2e93e61d67c274d891066238c74ba6322d527b6d) { $ib6d2cdf28e556d600dabcd9e147fd00d396277a5 = $i2e93e61d67c274d891066238c74ba6322d527b6d['count']; } } $if6cc45dd5b6ded71a17949f208a9712f4351c6ba = new Paginator($ib6d2cdf28e556d600dabcd9e147fd00d396277a5, MAX_ROWS, ((isset($_GET["ps"])) ? $_GET["ps"] : 1), $this->smsLinkPageSave($this->filter)); if($ib6d2cdf28e556d600dabcd9e147fd00d396277a5 > 0) { $i02fcabda2448d40bdb76bd10f9e95950039649ee .=' <fieldset> <legend><img src="' . self::$catalogImg . '" /> ' . v_smshistory_results . ($if6cc45dd5b6ded71a17949f208a9712f4351c6ba->offset + 1) . " - " . ((($if6cc45dd5b6ded71a17949f208a9712f4351c6ba->offset + $if6cc45dd5b6ded71a17949f208a9712f4351c6ba->limit) <= ($if6cc45dd5b6ded71a17949f208a9712f4351c6ba->num_results)) ? ($if6cc45dd5b6ded71a17949f208a9712f4351c6ba->offset + $if6cc45dd5b6ded71a17949f208a9712f4351c6ba->limit) : $if6cc45dd5b6ded71a17949f208a9712f4351c6ba->num_results) . v_smshistory_of . $if6cc45dd5b6ded71a17949f208a9712f4351c6ba->num_results . ' ' . v_smshistory_sms . '</legend>'; $i02fcabda2448d40bdb76bd10f9e95950039649ee .= " <table class=\"resultTable\"> <thead> <tr> <th class=\"left\">" . v_smshistory_nubmer . "</th> <th class=\"w150\">" . v_smshistory_recipient . "</th> <th class=\"w200\">" . v_smshistory_subject . "</th> <th class=\"w150\">" . v_smshistory_date . "</th> <th class=\"w150\">" . v_smshistory_type . "</th> <th class=\"w50\">" . v_smshistory_status . "</th> </tr> </thead> <tbody> "; $i83d1339527a9dc91b02fa99420eb13b0cd47adfe = $this->Execute($this->historySQL($i7bb23f2129d71956fd95288eaa834df71e09419e, $ibf21559a5865d0706b08586780050d04efc951d3, $i088e5493da345fd9a50093a74c3f1d122db69ddd, $if6cc45dd5b6ded71a17949f208a9712f4351c6ba->offset, $if6cc45dd5b6ded71a17949f208a9712f4351c6ba->limit)); if($i83d1339527a9dc91b02fa99420eb13b0cd47adfe->num_rows) { foreach($i83d1339527a9dc91b02fa99420eb13b0cd47adfe->rows as $i2e93e61d67c274d891066238c74ba6322d527b6d) { if(strlen($i2e93e61d67c274d891066238c74ba6322d527b6d['sender']) > 0 && preg_match("/^([0-9])*$/", $i2e93e61d67c274d891066238c74ba6322d527b6d['sender'], $i692db588ebe47958986d369fc4502d8d939dac97)) { $i23f70a3cdefc341374c8fc47e3cdb6b53c5edb1c = htmlspecialchars("+" . $i2e93e61d67c274d891066238c74ba6322d527b6d['sender']); } elseif(strlen($i2e93e61d67c274d891066238c74ba6322d527b6d['sender']) > 0) { $i23f70a3cdefc341374c8fc47e3cdb6b53c5edb1c = htmlspecialchars($i2e93e61d67c274d891066238c74ba6322d527b6d['sender']); } else { $i23f70a3cdefc341374c8fc47e3cdb6b53c5edb1c = v_smshistory_sysnumber; } $i3aa3b6bd09f39e42e2b394287f610dd81fcffa78 = ''; if(($i2e93e61d67c274d891066238c74ba6322d527b6d['status'] == SmsModel::STATUS_ERROR || $i2e93e61d67c274d891066238c74ba6322d527b6d['status'] == SmsModel::STATUS_BUFFERED) && strlen($i2e93e61d67c274d891066238c74ba6322d527b6d['note']) > 0) { $i3aa3b6bd09f39e42e2b394287f610dd81fcffa78 = " - " . htmlspecialchars($i2e93e61d67c274d891066238c74ba6322d527b6d['note']); } if(strlen($i2e93e61d67c274d891066238c74ba6322d527b6d["number"]) > 1) { $i6de5513d7bf66573dedf3f2f853ce5457a8f957f = htmlspecialchars($i2e93e61d67c274d891066238c74ba6322d527b6d["number"]); } else { $i6de5513d7bf66573dedf3f2f853ce5457a8f957f = v_adminsmsprofile_invalidnumber; } if($i2e93e61d67c274d891066238c74ba6322d527b6d['customer_ID'] != 0 && $i2e93e61d67c274d891066238c74ba6322d527b6d['customer_ID'] != -1) { $ia95f417022e395feb48959137203c276c5c4b322 = "<a href=\"" .$this->smsLinkCustomer($i2e93e61d67c274d891066238c74ba6322d527b6d["customer_ID"]). "\">" . htmlspecialchars($i2e93e61d67c274d891066238c74ba6322d527b6d["firstname"] . " " . $i2e93e61d67c274d891066238c74ba6322d527b6d["lastname"]) . "</a>"; } elseif($i2e93e61d67c274d891066238c74ba6322d527b6d['admin_ID'] != 0) { $ia95f417022e395feb48959137203c276c5c4b322 = htmlspecialchars($i2e93e61d67c274d891066238c74ba6322d527b6d["adminName"]); } elseif(strlen($i2e93e61d67c274d891066238c74ba6322d527b6d['recipient']) > 0) { $ia95f417022e395feb48959137203c276c5c4b322 = htmlspecialchars($i2e93e61d67c274d891066238c74ba6322d527b6d['recipient']); } else { $ia95f417022e395feb48959137203c276c5c4b322 = "-"; } $i02fcabda2448d40bdb76bd10f9e95950039649ee .= " <tr " . self::isEven($i0018d0cb00e9a7ab65cdbd7f1c6b001b1e0222a6, "even") . "> <td> <a id=\"displayText" . $i2e93e61d67c274d891066238c74ba6322d527b6d['ID'] . "\" href=\"javascript:\" onclick=\"toggleInfo(" . $i2e93e61d67c274d891066238c74ba6322d527b6d['ID'] . ");\"> <img src='" . self::$plusImg . "' alt=\"" . $i6de5513d7bf66573dedf3f2f853ce5457a8f957f . "\" id=\"toggleButton" . $i2e93e61d67c274d891066238c74ba6322d527b6d['ID'] . "\"/> " . $i6de5513d7bf66573dedf3f2f853ce5457a8f957f . " </a> </td> <td class=\"center\"> " . $ia95f417022e395feb48959137203c276c5c4b322 . " </td> <td class=\"center\">" . ((strlen($i2e93e61d67c274d891066238c74ba6322d527b6d['subject']) > 0) ? ($i2e93e61d67c274d891066238c74ba6322d527b6d['subject']) : ("-")) . "</td> <td class=\"center\">" . $i2e93e61d67c274d891066238c74ba6322d527b6d['date'] . "</td> <td class=\"center\">" . $i8d0bfc4e5c6ec343168005e262411ae0e2a293cb[$i2e93e61d67c274d891066238c74ba6322d527b6d['type']] . "</td> <td class=\"center\"> <span style=\"cursor:help;\" onclick=\"popup_title(this)\" title=\"" . (($i2e93e61d67c274d891066238c74ba6322d527b6d["status"] == SmsModel::STATUS_SIMULATION)?(v_sendsms_simulation):($i7fb9e90bc870bb7152647e673ad3beb8d1ae1a74[$i2e93e61d67c274d891066238c74ba6322d527b6d['status']] . $i3aa3b6bd09f39e42e2b394287f610dd81fcffa78)) . "\"> <img src='" . $i3f7c957cf91980835868755b4522fdafe03da70f[$i2e93e61d67c274d891066238c74ba6322d527b6d['status']] . "' alt=\"" . (($i2e93e61d67c274d891066238c74ba6322d527b6d["status"] == SmsModel::STATUS_SIMULATION)?(v_sendsms_simulation):($i7fb9e90bc870bb7152647e673ad3beb8d1ae1a74[$i2e93e61d67c274d891066238c74ba6322d527b6d['status']] . $i3aa3b6bd09f39e42e2b394287f610dd81fcffa78)) . "\" /> </span> </td> </tr> <tr id=\"toggleText" . $i2e93e61d67c274d891066238c74ba6322d527b6d['ID'] . "\" class=\"hidden noHover\"> <td colspan=\"6\"> <table class=\"formTable\"> <tr> <td colspan=\"6\"><strong>" . v_smshistory_smstext . "</strong><br /><pre>" . $i2e93e61d67c274d891066238c74ba6322d527b6d['text'] . "</pre></td> </tr> <tr> <td class=\"w160\"><strong>" . v_smshistory_price . "</strong> " . $i2e93e61d67c274d891066238c74ba6322d527b6d['price'] . "</td> <td class=\"w160\"><strong>" . v_smshistory_balance . "</strong> " . (($i2e93e61d67c274d891066238c74ba6322d527b6d['price'] > 0) ? $i2e93e61d67c274d891066238c74ba6322d527b6d["credit"] : " - ") . "</td> <td class=\"w100\"><strong>" . v_smshistory_totalsms . "</strong> " . $i2e93e61d67c274d891066238c74ba6322d527b6d['total'] . "</td> <td class=\"w100\"><strong>" . v_smshistory_unicode . "</strong> " . $i50fa9bd77200446bffa598146260f67a8d3c8aac[$i2e93e61d67c274d891066238c74ba6322d527b6d['unicode']] . "</td> <td class=\"w220\"><strong>" . v_smshistory_senderid . "</strong> " . $i23f70a3cdefc341374c8fc47e3cdb6b53c5edb1c . "</td> <td><strong>SMS ID:</strong> " . ((strlen($i2e93e61d67c274d891066238c74ba6322d527b6d['smsID'])) ? $i2e93e61d67c274d891066238c74ba6322d527b6d['smsID'] : " - ") . "</td> </tr> </table> </td> </tr> "; } } $i02fcabda2448d40bdb76bd10f9e95950039649ee .= " </tbody> </table> "; $i02fcabda2448d40bdb76bd10f9e95950039649ee .= $if6cc45dd5b6ded71a17949f208a9712f4351c6ba; } else { $i02fcabda2448d40bdb76bd10f9e95950039649ee .= ' <div> <b>' . v_smshistory_nosms . '</b> </div>'; } $i02fcabda2448d40bdb76bd10f9e95950039649ee .= " <script language=\"javascript\"> var minus = '" . self::$minusImg . "'; var plus = '" . self::$plusImg . "'; </script> "; $i02fcabda2448d40bdb76bd10f9e95950039649ee .= '</fieldset>'; return $i02fcabda2448d40bdb76bd10f9e95950039649ee; } } ?>