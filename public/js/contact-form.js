document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("contactForm");
    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            fetch(form.action, {
                method: "POST",
                body: formData,
                headers: {
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": csrfToken,
                },
            })
                .then((response) => {
                    // Kiểm tra response
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return response.json();
                })
                .then((data) => {
                    if (data.success) {
                        alert(data.message);
                        form.reset();
                    } else {
                        alert(data.message || "Submission failed");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("An error occurred");
                });
        });
    }
});
