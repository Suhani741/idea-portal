// Handle the feedback form for each idea
function toggleFeedbackForm(ideaId) {
    const feedbackForm = document.getElementById('feedback-form-' + ideaId);
    feedbackForm.style.display = feedbackForm.style.display === 'none' ? 'block' : 'none';
}

function submitFeedback(ideaId) {
    const feedbackText = document.getElementById('feedback-text-' + ideaId).value;
    const formData = new FormData();
    formData.append('idea_id', ideaId);
    formData.append('feedback', feedbackText);

    fetch('submit_feedback.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert('Feedback submitted successfully!');
        location.reload(); // Reload the page to update the feedback
    })
    .catch(error => {
        console.error('Error submitting feedback:', error);
        alert('Failed to submit feedback.');
    });
}
