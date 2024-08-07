<?php
// Set the response header to JSON
header('Content-Type: application/json');

// Get the JSON data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

// Establish database connection
$conn = new mysqli("localhost", "username", "password", "database_name");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cafes
$cafes = [];
$sql = "SELECT * FROM Cafe";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $cafes[] = $row;
}

// Fetch penilaian
$penilaian = [];
$sql = "SELECT * FROM Penilaian";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $penilaian[] = $row;
}

// Fetch kriteria weights
$kriteria_weights = [];
$sql = "SELECT * FROM BobotKriteria";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $kriteria_weights[$row['KriteriaID']] = $row['Bobot'];
}

// Adjust weights based on user selection
$selected_criteria = [
    'fasilitas' => 1,
    'lokasi' => 2,
    'suasana' => 3,
    'harga_makanan' => 4,
    'harga_minuman' => 5,
    'menu_makanan' => 6,
    'menu_minuman' => 7
];

foreach ($selected_criteria as $key => $value) {
    if (isset($data[$key])) {
        $kriteria_weights[$value] += 0.05;
    }
}

// Normalize scores
$total_scores = [];
foreach ($penilaian as $p) {
    if (!isset($total_scores[$p['KriteriaID']])) {
        $total_scores[$p['KriteriaID']] = 0;
    }
    $total_scores[$p['KriteriaID']] += $p['Score'];
}

$normalized_penilaian = [];
foreach ($penilaian as $p) {
    $normalized_score = $p['Score'] / $total_scores[$p['KriteriaID']];
    $normalized_penilaian[] = [
        'CafeID' => $p['CafeID'],
        'KriteriaID' => $p['KriteriaID'],
        'NormalizedScore' => $normalized_score
    ];
}

// Calculate final scores
$final_scores = [];
foreach ($normalized_penilaian as $np) {
    if (!isset($final_scores[$np['CafeID']])) {
        $final_scores[$np['CafeID']] = 0;
    }
    $final_scores[$np['CafeID']] += $np['NormalizedScore'] * $kriteria_weights[$np['KriteriaID']];
}

// Sort cafes by final score
arsort($final_scores);

$result = [];
foreach ($final_scores as $cafe_id => $score) {
    $cafe_name = array_filter($cafes, function ($cafe) use ($cafe_id) {
        return $cafe['CafeID'] == $cafe_id;
    });
    $cafe_name = array_values($cafe_name)[0]['CafeName'];
    $result[] = ['CafeID' => $cafe_id, 'CafeName' => $cafe_name, 'TotalScore' => $score];
}

// Close database connection
$conn->close();

// Return the result as JSON
echo json_encode($result);
?>