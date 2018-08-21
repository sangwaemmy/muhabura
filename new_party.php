 

<input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
<!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

<tr><td><label for="txt_tuple">Name </label></td><td> <input  type="text"   autocomplete="off"  name="txt_name" required id="txt_name" class="textbox" value="<?php echo trim(chosen_name_upd()); ?>"   />  </td></tr>
<tr><td><label for="txt_tuple">Email </label></td><td> <input type="text"   autocomplete="off" name="txt_email" required id="txt_email" class="textbox" value="<?php echo trim(chosen_email_upd()); ?>"   />  </td></tr>
<tr><td><label for="txt_tuple">website </label></td><td> <input type="text" autocomplete="off" name="txt_website" placeholder="Optional" id="txt_website" class="textbox" value="<?php echo trim(chosen_website_upd()); ?>"   />  </td></tr>
<tr><td><label for="txt_tuple">Phone </label></td><td> <input type="text"   autocomplete="off" name="txt_phone"   id="txt_phone" class="textbox" value="<?php echo trim(chosen_phone_upd()); ?>"   />  </td></tr>
<tr class="off"><td><label for="txt_tuple">Is Active </label></td><td> <input type="text"     name="txt_is_active"  id="txt_is_active" class="textbox" value="<?php echo trim(chosen_is_active_upd()); ?>"   />  </td></tr>

<?php

    function chosen_party_type_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'party') {
                $id = $_SESSION['id_upd'];
                $party_type = new multi_values();
                return $party_type->get_chosen_party_party_type($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_name_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'party') {
                $id = $_SESSION['id_upd'];
                $name = new multi_values();
                return $name->get_chosen_party_name($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_email_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'party') {
                $id = $_SESSION['id_upd'];
                $email = new multi_values();
                return $email->get_chosen_party_email($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_website_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'party') {
                $id = $_SESSION['id_upd'];
                $website = new multi_values();
                return $website->get_chosen_party_website($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_phone_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'party') {
                $id = $_SESSION['id_upd'];
                $phone = new multi_values();
                return $phone->get_chosen_party_phone($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_is_active_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'party') {
                $id = $_SESSION['id_upd'];
                $is_active = new multi_values();
                return $is_active->get_chosen_party_is_active($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    