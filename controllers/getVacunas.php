<?php
// /TFG/controllers/getVacunas.php
header('Content-Type: application/json');

$vacunas = [
  "Hexavalente",
  "Neumococo conjugada",
  "Rotavirus",
  "Meningococo B",
  "Meningococo ACWY",
  "Triple Vírica",
  "Varicela",
  "Virus del Papiloma Humano",
  "Gripe y COVID-19",
  "VRS"
];

echo json_encode($vacunas);
