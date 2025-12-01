<?php
include "includes/header.php";
include "db.php";

if($_SERVER['REQUEST_METHOD']=='POST'){
    // 1. Get Data
    $name = $conn->real_escape_string($_POST['name']);
    $category = $conn->real_escape_string($_POST['category']);
    $type = $conn->real_escape_string($_POST['type']);
    $use_for = $conn->real_escape_string($_POST['use_for']);
    $how_it_works = $conn->real_escape_string($_POST['how_it_works']);
    $safety = $conn->real_escape_string($_POST['safety']);

    // 2. Handle Image
    $imageName = null;
    if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
        $imageName = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);
    }

    // 3. Insert Data
    $sql = "INSERT INTO medicines (name, category, type, use_for, how_it_works, safety, image)
            VALUES ('$name','$category','$type','$use_for','$how_it_works','$safety','$imageName')";

    if($conn->query($sql)){
        // Success: Redirect
        echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'Medicine added successfully.',
                icon: 'success',
                confirmButtonColor: '#0f766e'
            }).then(() => {
                window.location='index.php';
            });
        </script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>

<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold text-dark m-0">Add New Medicine</h2>
                        <a href="index.php" class="btn btn-light rounded-circle"><i class="bi bi-x-lg"></i></a>
                    </div>

                    <form method="POST" enctype="multipart/form-data" id="medicineForm">
                        
                        <h6 class="text-uppercase text-muted small fw-bold mb-3">Basic Information</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
                                    <label for="name">Medicine Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="category" class="form-select" id="category" required>
                                        <option value="">Select...</option>
                                        <option value="Pain Reliever">Pain Reliever</option>
                                        <option value="Antihistamine">Antihistamine</option>
                                        <option value="Antibiotic">Antibiotic</option>
                                        <option value="Vitamin">Vitamin</option>
                                        <option value="Cough & Cold">Cough & Cold</option>
                                    </select>
                                    <label for="category">Category</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="type" class="form-select" id="type" required>
                                        <option value="">Select...</option>
                                        <option value="Analgesic / Antipyretic">Analgesic / Antipyretic</option>
                                        <option value="Antihistamine">Antihistamine</option>
                                        <option value="Antibiotic">Antibiotic</option>
                                        <option value="Supplement / Vitamin">Supplement / Vitamin</option>
                                        <option value="Cough Suppressant">Cough Suppressant</option>
                                    </select>
                                    <label for="type">Type</label>
                                </div>
                            </div>
                        </div>

                        <h6 class="text-uppercase text-muted small fw-bold mb-3 mt-4">Clinical Details</h6>
                        <div class="mb-3 form-floating">
                            <textarea name="use_for" class="form-control" style="height: 100px" id="use" placeholder="Used For" required></textarea>
                            <label for="use">Used For</label>
                        </div>
                        <div class="mb-3 form-floating">
                            <textarea name="how_it_works" class="form-control" style="height: 100px" id="how" placeholder="How it works" required></textarea>
                            <label for="how">How It Works</label>
                        </div>
                        <div class="mb-3 form-floating">
                            <textarea name="safety" class="form-control" style="height: 100px" id="safe" placeholder="Safety" required></textarea>
                            <label for="safe">Safety Instructions</label>
                        </div>

                        <h6 class="text-uppercase text-muted small fw-bold mb-3 mt-4">Visuals</h6>
                        <div class="mb-4">
                            <label class="form-label text-muted small">Upload Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg" id="saveBtn">Save Medicine</button>
                            <a href="index.php" class="btn btn-light btn-lg text-muted">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('medicineForm').addEventListener('submit', function() {
        const btn = document.getElementById('saveBtn');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...';
        btn.disabled = true; // Disables the button so you can't click it twice
    });
</script>

<?php include "includes/footer.php"; ?>