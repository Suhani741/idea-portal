document.addEventListener('DOMContentLoaded', () => {
    fetchIdeas();
    fetchTeams();
});

function fetchIdeas() {
    fetch('faculty_dashboard.php?action=fetchIdeas')
        .then(response => response.json())
        .then(data => {
            const ideasTable = document.getElementById('ideas-table');
            ideasTable.innerHTML = data.map(idea => `
                <tr>
                    <td>${idea.idea_id}</td>
                    <td>${idea.title}</td>
                    <td>${idea.abstract}</td>
                    <td>${idea.status}</td>
                    <td><button onclick="giveFeedback(${idea.idea_id})">Feedback</button></td>
                </tr>
            `).join('');
        });
}

function fetchTeams() {
    fetch('faculty_dashboard.php?action=fetchTeams')
        .then(response => response.json())
        .then(data => {
            const teamsTable = document.getElementById('teams-table');
            teamsTable.innerHTML = data.map(team => `
                <tr>
                    <td>${team.team_id}</td>
                    <td>${team.team_leader}</td>
                    <td>${team.members.join(', ')}</td>
                    <td>${team.title}</td>
                </tr>
            `).join('');
        });
}

function giveFeedback(ideaId) {
    const feedback = prompt('Enter your feedback:');
    if (feedback) {
        fetch('faculty_dashboard.php?action=submitFeedback', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ idea_id: ideaId, feedback })
        }).then(() => alert('Feedback submitted.'));
    }
}

