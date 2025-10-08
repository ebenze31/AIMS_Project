@extends('layouts.theme_aims')

@section('content')
<style>
    :root {
    --primary-blue: #0d6efd;
    --primary-blue-hover: #0b5ed7;
    --star-color: #ffc107;
    --star-background: #e9ecef;
    --background-color: #f8f9fa;
    --text-dark: #212529;
    --text-muted: #6c757d;
    --border-color: #dee2e6;
    --white: #ffffff;
    --font-family: 'Sarabun', sans-serif;
}

/* --- General Styling --- */
body {
    font-family: var(--font-family);
    background-color: var(--background-color);
    color: var(--text-dark);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
    box-sizing: border-box;
}

/* --- Rating Card --- */
.rating-card {
    background-color: var(--white);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    box-shadow: 0 4px 25px rgba(0,0,0,0.08);
    width: 100%;
    max-width: 500px;
    overflow: hidden;
}

.card-header {
    text-align: center;
    padding: 30px 25px 25px 25px;
    border-bottom: 1px solid var(--border-color);
}
.header-icon {
    width: 50px;
    height: 50px;
    margin: 0 auto 15px auto;
    background-color: var(--primary-blue);
    color: var(--white);
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.header-icon svg {
    width: 28px;
    height: 28px;
}
.card-header h2 {
    font-size: 24px;
    font-weight: 700;
    margin: 0 0 5px 0;
}
.card-header p {
    font-size: 16px;
    color: var(--text-muted);
    margin: 0;
}

.card-body {
    padding: 25px;
}

/* --- Form Elements --- */
.rating-group {
    margin-bottom: 25px;
}
.rating-label {
    display: block;
    font-size: 18px;
    font-weight: 500;
    margin-bottom: 12px;
}

/* --- Interactive Star Rating --- */
.interactive-star-rating {
    display: flex;
    flex-direction: row-reverse; /* Important for the hover effect */
    justify-content: flex-end;
}
.interactive-star-rating .star {
    font-size: 40px;
    color: var(--star-background);
    cursor: pointer;
    transition: color 0.2s ease-out;
}
.interactive-star-rating .star:hover,
.interactive-star-rating .star:hover ~ .star,
.interactive-star-rating .star.selected,
.interactive-star-rating .star.selected ~ .star {
    color: var(--star-color);
}

/* --- Text Area --- */
textarea {
    width: 100%;
    padding: 12px;
    font-family: var(--font-family);
    font-size: 16px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    box-sizing: border-box;
    resize: vertical;
    transition: border-color 0.2s, box-shadow 0.2s;
}
textarea:focus {
    outline: none;
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
}

/* --- Submit Button --- */
.btn-submit {
    width: 100%;
    padding: 15px;
    font-family: var(--font-family);
    font-size: 18px;
    font-weight: 700;
    color: var(--white);
    background-color: var(--primary-blue);
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.2s;
}
.btn-submit:hover {
    background-color: var(--primary-blue-hover);
}
</style>
<div class="rating-card">
    <div class="card-header">
        <div class="header-icon">
           <i class="fa-solid fa-star"></i>
        </div>
        <h2>ประเมินความพึงพอใจ</h2>
        <p>ความคิดเห็นของคุณมีความสำคัญต่อการพัฒนาของเรา</p>
    </div>

    <div class="card-body">
        <form id="rating-form">
            <div class="rating-group">
                <label class="rating-label">คะแนนความประทับใจ</label>
                <div class="interactive-star-rating" data-rating-for="impression">
                    <span class="star" data-value="1">★</span>
                    <span class="star" data-value="2">★</span>
                    <span class="star" data-value="3">★</span>
                    <span class="star" data-value="4">★</span>
                    <span class="star" data-value="5">★</span>
                </div>
                <input type="hidden" name="impression_score" id="impression_score">
            </div>

            <div class="rating-group">
                <label class="rating-label">คะแนนความรวดเร็ว</label>
                <div class="interactive-star-rating" data-rating-for="speed">
                    <span class="star" data-value="1">★</span>
                    <span class="star" data-value="2">★</span>
                    <span class="star" data-value="3">★</span>
                    <span class="star" data-value="4">★</span>
                    <span class="star" data-value="5">★</span>
                </div>
                <input type="hidden" name="speed_score" id="speed_score">
            </div>

            <div class="rating-group">
                <label for="feedback-text" class="rating-label">คำแนะนำ / ติชม (ถ้ามี)</label>
                <textarea id="feedback-text" name="feedback" rows="4" placeholder="บอกเราเพิ่มเติม..."></textarea>
            </div>

            <button type="submit" class="btn-submit">ส่งการประเมิน</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const ratingGroups = document.querySelectorAll('.interactive-star-rating');

    ratingGroups.forEach(group => {
        const stars = group.querySelectorAll('.star');
        const hiddenInputId = group.dataset.ratingFor + '_score';
        const hiddenInput = document.getElementById(hiddenInputId);

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = this.dataset.value;
                hiddenInput.value = value; // Set value to hidden input

                // Remove 'selected' from all stars in the group
                stars.forEach(s => s.classList.remove('selected'));

                // Add 'selected' to clicked star and all previous stars
                for (let i = 0; i < value; i++) {
                    stars[i].classList.add('selected');
                }
            });
        });
    });

    // Handle form submission
    const form = document.getElementById('rating-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent actual form submission for this demo

        const impressionScore = document.getElementById('impression_score').value;
        const speedScore = document.getElementById('speed_score').value;
        const feedback = document.getElementById('feedback-text').value;

        if (!impressionScore || !speedScore) {
            alert('กรุณาให้คะแนนทั้งสองหัวข้อ');
            return;
        }

        console.log('คะแนนความประทับใจ:', impressionScore);
        console.log('คะแนนความรวดเร็ว:', speedScore);
        console.log('คำติชม:', feedback);

        alert('ขอบคุณสำหรับการประเมิน!');
        // Here you would typically send the data to a server
        // e.g., using fetch()
    });
});
</script>
@endsection
