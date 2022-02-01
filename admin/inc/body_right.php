<?php
if (isset($_GET['cat'])) {
    include("category.php");
}

if (isset($_GET['sub_cat'])) {
    include("sub_category.php");
}

if (isset($_GET['edit_cat'])) {
    include("edit_category.php");
}

if (isset($_GET['edit_sub_cat'])) {
    include("edit_sub_category.php");
}

if (isset($_GET['lang'])) {
    include("language.php");
}

if (isset($_GET['edit_lang'])) {
    include("edit_language.php");
}

if (isset($_GET['term'])) {
    include("term.php");
}

if (isset($_GET['edit_term'])) {
    include("edit_term.php");
}

if (isset($_GET['contact'])) {
    include("contact.php");
}

if (isset($_GET['faq'])) {
    include("faq.php");
}