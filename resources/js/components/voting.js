export default () => ({
    votes: {},
    loading: false,
    selectedContestant: null,
    showVoteSuccess: false,
    activeShare: null,

    init() {
        this.votes = JSON.parse(this.$el.dataset.votes);
        this.startLiveUpdates();
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
                this.votes[contestantId] = data.votes;
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
});
