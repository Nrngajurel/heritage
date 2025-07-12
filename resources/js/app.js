import Alpine from 'alpinejs';

// Initialize Alpine.js
window.Alpine = Alpine;

// Register voting component
document.addEventListener('alpine:init', () => {
    Alpine.data('voting', () => ({
        votes: {},
        loading: false,
        selectedContestant: null,
        showVoteSuccess: false,
        activeShare: null,
        copied: false,
        can_vote: true,

        init() {
            this.updateCanVote();
            try {
                const votesData = this.$el.dataset.votes;
                if (votesData) {
                    this.votes = JSON.parse(votesData);
                    this.startLiveUpdates();
                } else {
                    console.error('No votes data found');
                }
            } catch (error) {
                console.error('Error parsing votes data:', error);
            }
        },


        get voteUrl() {
            return window.location.origin + '/vote/' + this.activeShare?.id;
        },

        startLiveUpdates() {
            const contestantIds = Object.keys(this.votes);
            setInterval(() => {
                const randomIndex = Math.floor(Math.random() * contestantIds.length);
                const randomContestant = contestantIds[randomIndex];
                if (Math.random() > 0.7) {
                    this.votes[randomContestant]++;
                    this.updateProgressBars();
                }
            }, 2000);
        },

        getTotalVotes() {
            return Object.values(this.votes).reduce((a, b) => a + b, 0);
        },

        getVotePercentage(contestantId) {
            return (this.votes[contestantId] / this.getTotalVotes() * 100).toFixed(1);
        },
        updateCanVote() {
            // user can vote once a day if the  last_vote_at is set on localStorage and is more than 24 hours ago
            const last_vote_at = localStorage.getItem('last_vote_at');
            if (last_vote_at) {
                const last_vote_date = new Date(last_vote_at);
                const now = new Date();
                const diff = now.getTime() - last_vote_date.getTime();
                const diffInHours = diff / (1000 * 60 * 60);
                if (diffInHours < 24) {
                    this.can_vote = false;
                }else{
                    this.can_vote = true;
                }
            }else{
                this.can_vote = true;
            }
        },

        async castVote(contestantId) {
            if (this.loading) return;

            this.loading = true;
            const button = document.querySelector(`#vote-button-${contestantId}`);
            button.classList.add('animate-shine');

            try {
                const response = await fetch(`/vote/${contestantId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    localStorage.setItem('last_vote_at', new Date().toISOString());
                    this.updateCanVote();
                    
                    this.votes[contestantId] = data.votes;

                    console.log(data);
                    this.showVoteSuccess = true;
                    this.updateProgressBars();
                    setTimeout(() => {
                        this.showVoteSuccess = false;
                        button.classList.remove('animate-shine');
                    }, 2000);
                } else {
                    alert('Failed to cast vote. Please try again.');
                }
            } catch (error) {
                alert('An error occurred while voting. Please try again.');
            } finally {
                this.loading = false;
            }
        },

        updateProgressBars() {
            const total = this.getTotalVotes();
            Object.keys(this.votes).forEach(id => {
                const percentage = (this.votes[id] / total * 100).toFixed(1);
                const bar = document.querySelector(`#progress-${id}`);
                if (bar) bar.style.width = `${percentage}%`;
            });
        },

        formatNumber(num) {
            return new Intl.NumberFormat().format(num);
        }
    }));
});

Alpine.start();