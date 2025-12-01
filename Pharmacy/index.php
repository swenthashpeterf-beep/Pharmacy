<?php
include "includes/header.php";
include "db.php";

$search = $_GET['search'] ?? '';
$filter = $_GET['category'] ?? '';

$query = "SELECT * FROM medicines WHERE 1";
if ($search != '') {
    $searchEscaped = $conn->real_escape_string($search);
    $query .= " AND name LIKE '%$searchEscaped%'";
}
if ($filter != '' && strtolower($filter) != 'all') {
    $filterEscaped = $conn->real_escape_string($filter);
    $query .= " AND category LIKE '%$filterEscaped%'";
}
$result = $conn->query($query);
?>

<div class="container pb-5">
    
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h2 class="fw-bold text-dark mb-1">Medicine Inventory</h2>
            <p class="text-muted">Manage and track your pharmaceutical stock.</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="add.php" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-lg me-2"></i>Add New Medicine
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0 p-3 mb-5 rounded-4">
        <div class="row g-3 align-items-center">
            <div class="col-md-4">
                <form method="GET" class="d-flex">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 rounded-start-3 ps-3">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 rounded-end-3" placeholder="Search medicines..." name="search" value="<?php echo htmlspecialchars($search); ?>">
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                    <?php
                    $categories = ['All', 'Pain Reliever', 'Antihistamine', 'Antibiotic', 'Vitamin', 'Cough & Cold'];
                    foreach ($categories as $cat) {
                        $isActive = ($filter == $cat || ($filter == '' && $cat == 'All'));
                        $class = $isActive ? 'btn-primary' : 'btn-light text-muted';
                        echo "<a href='?category=" . urlencode($cat) . "' class='btn $class rounded-pill btn-sm px-3'>$cat</a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col">
            <div class="card medicine-card h-100 shadow-sm">
                <div class="medicine-img-wrapper">
                    <?php if ($row['image']): ?>
                        <img src="uploads/<?php echo $row['image']; ?>" class="medicine-img" alt="<?php echo $row['name']; ?>">
                    <?php else: ?>
                        <div class="text-muted text-center p-4">
                            <i class="bi bi-image fs-1 opacity-25"></i><br>No Image
                        </div>
                    <?php endif; ?>
                </div>

                <div class="card-body d-flex flex-column">
                    <div class="mb-2">
                        <span class="badge-category"><?php echo $row['category']; ?></span>
                    </div>
                    <h5 class="card-title fw-bold mb-1 text-dark"><?php echo $row['name']; ?></h5>
                    <p class="card-text small text-muted mb-3 text-truncate"><?php echo $row['type']; ?></p>
                    
                    <div class="mt-auto d-flex align-items-center justify-content-between pt-3 border-top">
                        <a href="medicine.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-primary btn-sm rounded-3 px-3">
                            View Details
                        </a>
                        <div class="d-flex gap-2">
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-action-icon btn-light text-warning" title="Edit">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this medicine?');" class="btn btn-action-icon btn-light text-danger" title="Delete">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include "includes/footer.php"; ?>