<?php
include "includes/header.php";
include "db.php";

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM medicines WHERE id=$id");
$med = $result->fetch_assoc();

if(!$med){
    echo "<script>window.location='index.php';</script>";
    exit;
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = $conn->real_escape_string($_POST['name']);
    $category = $conn->real_escape_string($_POST['category']);
    $type = $conn->real_escape_string($_POST['type']);
    $use_for = $conn->real_escape_string($_POST['use_for']);
    $how_it_works = $conn->real_escape_string($_POST['how_it_works']);
    $safety = $conn->real_escape_string($_POST['safety']);

    // Handle Image Update
    if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
        $imageName = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);
        // Update with image
        $sql = "UPDATE medicines SET name='$name', category='$category', type='$type', 
                use_for='$use_for', how_it_works='$how_it_works', safety='$safety', image='$imageName' WHERE id=$id";
    } else {
        // Update without changing image
        $sql = "UPDATE medicines SET name='$name', category='$category', type='$type', 
                use_for='$use_for', how_it_works='$how_it_works', safety='$safety' WHERE id=$id";
    }

    if($conn->query($sql)){
        echo "<script>
            Swal.fire({
                title: 'Updated!',
                text: 'Medicine details updated.',
                icon: 'success',
                confirmButtonColor: '#0f766e'
            }).then(() => {
                window.location='index.php';
            });
        </script>";
    }
}
?>

<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold text-dark m-0">Edit Medicine</h2>
                        <a href="index.php" class="btn btn-light rounded-circle"><i class="bi bi-x-lg"></i></a>
                    </div>

                    <form method="POST" enctype="multipart/form-data" id="editForm">
                        
                        <h6 class="text-uppercase text-muted small fw-bold mb-3">Basic Information</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control" id="name" value="<?php echo $med['name']; ?>" required>
                                    <label for="name">Medicine Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="category" class="form-select" id="category" required>
                                        <?php
                                        $categories = ['Pain Reliever','Antihistamine','Antibiotic','Vitamin','Cough & Cold'];
                                        foreach($categories as $cat){
                                            $selected = ($med['category'] == $cat) ? "selected" : "";
                                            echo "<option value='$cat' $selected>$cat</option>";
                                        }
                                        ?>
                                    </select>
                                    <label for="category">Category</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="type" class="form-select" id="type" required>
                                        <?php
                                        $types = ['Analgesic / Antipyretic','Antihistamine','Antibiotic','Supplement / Vitamin','Cough Suppressant'];
                                        foreach($types as $t){
                                            $selected = ($med['type'] == $t) ? "selected" : "";
                                            echo "<option value='$t' $selected>$t</option>";
                                        }
                                        ?>
                                    </select>
                                    <label for="type">Type</label>
                                </div>
                            </div>
                        </div>

                        <h6 class="text-uppercase text-muted small fw-bold mb-3 mt-4">Clinical Details</h6>
                        <div class="mb-3 form-floating">
                            <textarea name="use_for" class="form-control" style="height: 100px" id="use" required><?php echo $med['use_for']; ?></textarea>
                            <label for="use">Used For</label>
                        </div>
                        <div class="mb-3 form-floating">
                            <textarea name="how_it_works" class="form-control" style="height: 100px" id="how" required><?php echo $med['how_it_works']; ?></textarea>
                            <label for="how">How It Works</label>
                        </div>
                        <div class="mb-3 form-floating">
                            <textarea name="safety" class="form-control" style="height: 100px" id="safe" required><?php echo $med['safety']; ?></textarea>
                            <label for="safe">Safety Instructions</label>
                        </div>

                        <h6 class="text-uppercase text-muted small fw-bold mb-3 mt-4">Visuals</h6>
                        <?php if($med['image']): ?>
                            <div class="mb-2">
                                <small class="text-muted">Current Image:</small><br>
                                <img src="uploads/<?php echo $med['image']; ?>" class="img-thumbnail rounded" width="100">
                            </div>
                        <?php endif; ?>
                        
                        <div class="mb-4">
                            <label class="form-label text-muted small">Change Image (Optional)</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg" id="updateBtn">Update Medicine</button>
                            <a href="index.php" class="btn btn-light btn-lg text-muted">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('editForm').addEventListener('submit', function() {
        const btn = document.getElementById('updateBtn');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...';
        btn.disabled = true;
    });
</script>

<?php include "includes/footer.php"; ?>