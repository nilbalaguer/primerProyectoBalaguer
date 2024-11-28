<?php

if (!isset($_SESSION['id'])) {
    header("Location: ".url."usuario/iniciaSessio");
}