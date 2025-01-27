document.getElementById('generate-btn').addEventListener('click', function () {
    const subjectCode = document.getElementById('text-input').value;
    const qrCodeDiv = document.getElementById('qrcode');
    const downloadBtn = document.getElementById('download-btn');
  
    // Clear any existing QR Code
    qrCodeDiv.innerHTML = "";
    downloadBtn.style.display = "none";
  
    if (subjectCode.trim() === "") {
      alert("Please enter a subject code to generate the QR code.");
      return;
    }
  
    // Generate a local URL with the subject code as a query parameter
    const baseUrl = "http://localhost/5864nm/qrform1.html"; 
    const fullUrl = `${baseUrl}?subjectCode=${encodeURIComponent(subjectCode)}`;
  
    // Generate QR Code for the URL
    const qrCode = new QRCode(qrCodeDiv, {
      text: fullUrl,
      width: 200,
      height: 200,
      
    });
  
    // Show the download button after QR Code generation
    setTimeout(() => {
      const canvas = qrCodeDiv.querySelector("canvas");
      if (canvas) {
        downloadBtn.style.display = "inline-block";
        downloadBtn.onclick = function () {
          const link = document.createElement("a");
          link.href = canvas.toDataURL("image/png");
          link.download = `${subjectCode}.png`;
          link.click();
        };
      }
    }, 500); // Allow some time for the QR code to render
});
