@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mx-auto"> <!-- Đặt mx-auto để căn giữa -->
                <div class="card shadow-lg border-0 rounded-3 my-5">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold">Get in Touch</h2>
                            <p class="text-muted">We'd love to hear from you!</p>
                        </div>

                        <form id="contactForm" action="{{ route('submit.contact') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="name" name="name" type="text" placeholder="Enter your name" required>
                                        <label for="name">Full Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com" required>
                                        <label for="email">Email Address</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="phone" name="phone" type="tel" placeholder="Enter your phone number">
                                        <label for="phone">Phone Number</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="company" name="company" type="text" placeholder="Enter your company">
                                        <label for="company">Company Name</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="message" name="message" type="text" placeholder="Leave a message here" style="height: 10rem" required></textarea>
                                <label for="message">Message</label>
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-primary btn-lg" type="submit">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(form);

            fetch('/submit-contact', {
                method: 'POST',
                body: formData,
                credentials: 'same-origin', // Quan trọng để gửi cookie
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                // Log status để debug
                console.log('Response status:', response.status);

                // Kiểm tra content type
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    return response.json();
                } else {
                    // Nếu không phải JSON, đọc text để debug
                    return response.text().then(text => {
                        console.error('Non-JSON response:', text);
                        throw new Error('Received non-JSON response');
                    });
                }
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: data.message || 'Gửi tin nhắn thành công'
                    });
                    form.reset();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: data.message || 'Có lỗi xảy ra'
                    });
                }
            })
            .catch(error => {
                console.error('Submission Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: error.message || 'Có lỗi xảy ra'
                });
            });
        });
    }
});
</script>
@endpush
