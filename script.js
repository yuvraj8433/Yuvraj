// Password Modal Functions (Same as previous)

// Upload Functionality
document.getElementById('uploadForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData();
    const fileInput = document.getElementById('certificateFile');
    const isProtected = document.getElementById('isProtected').checked;
    
    formData.append('certificate', fileInput.files[0]);
    formData.append('isProtected', isProtected);
    
    try {
        const response = await fetch('upload.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('Certificate uploaded successfully!');
            // Refresh certificate list
        } else {
            alert('Upload failed: ' + result.error);
        }
    } catch (error) {
        console.error('Error:', error);
    }
});



