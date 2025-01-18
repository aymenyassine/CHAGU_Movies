<?php
session_start();
session_unset(); 
session_destroy(); 

// Réponse JSON au lieu de redirection
echo json_encode(['success' => true]);

exit;
?>
