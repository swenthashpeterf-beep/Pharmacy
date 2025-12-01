<?php
include "includes/header.php";
include "db.php";

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM medicines WHERE id=$id");
$med = $result->fetch_assoc();
?>

<div class="container mt-5 mb-5">
    <a href="index.php" class="btn btn-link text-decoration-none text-muted mb-3 ps-0">
        <i class="bi bi-arrow-left me-1"></i> Back to Inventory
    </a>

    <div class="row g-5">
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="p-5 bg-white d-flex justify-content-center align-items-center" style="min-height: 300px;">
                    <?php if($med['image']): ?>
                        <img src="uploads/<?php echo $med['image']; ?>" class="img-fluid rounded" style="max-height: 350px;" alt="Medicine">
                    <?php else: ?>
                        <i class="bi bi-image text-muted fs-1 opacity-25"></i>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm rounded-4 p-3">
                <div class="d-grid gap-2">
                    <a href="edit.php?id=<?php echo $med['id']; ?>" class="btn btn-warning text-white">
                        <i class="bi bi-pencil-square me-2"></i>Edit Details
                    </a>
                    <a href="delete.php?id=<?php echo $med['id']; ?>" onclick="return confirm('Are you sure?');" class="btn btn-outline-danger">
                        <i class="bi bi-trash me-2"></i>Delete Medicine
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="mb-4">
                <span class="badge-category mb-2 d-inline-block"><?php echo $med['category']; ?></span>
                <h1 class="fw-bold text-dark display-6"><?php echo $med['name']; ?></h1>
                <p class="text-muted fs-5"><?php echo $med['type']; ?></p>
            </div>

            <div class="vstack gap-4">
                
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-circle text-primary me-3">
                                <i class="bi bi-clipboard-pulse fs-4"></i>
                            </div>
                            <h5 class="fw-bold m-0">Used For</h5>
                        </div>
                        <p class="text-secondary m-0 lh-lg"><?php echo nl2br($med['use_for']); ?></p>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-info bg-opacity-10 p-2 rounded-circle text-info me-3">
                                <i class="bi bi-gear-wide-connected fs-4"></i>
                            </div>
                            <h5 class="fw-bold m-0">How It Works</h5>
                        </div>
                        <p class="text-secondary m-0 lh-lg"><?php echo nl2br($med['how_it_works']); ?></p>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-danger bg-opacity-10 p-2 rounded-circle text-danger me-3">
                                <i class="bi bi-shield-check fs-4"></i>
                            </div>
                            <h5 class="fw-bold m-0">Safety Information</h5>
                        </div>
                        <p class="text-secondary m-0 lh-lg"><?php echo nl2br($med['safety']); ?></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>