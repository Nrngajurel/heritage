const setup = () => {
    const getTheme = () => {
        if (window.localStorage.getItem('dark')) {
            return JSON.parse(window.localStorage.getItem('dark'))
        }
        return !!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
    }

    const setTheme = (value) => {
        window.localStorage.setItem('dark', value)
    }

    const getColor = () => {
        if (window.localStorage.getItem('color')) {
            return window.localStorage.getItem('color')
        }
        return 'cyan'
    }

    const setColors = (color) => {
        const root = document.documentElement
        root.style.setProperty('--color-red', `var(--color-${color})`)
        root.style.setProperty('--color-red-50', `var(--color-${color}-50)`)
        root.style.setProperty('--color-red-100', `var(--color-${color}-100)`)
        root.style.setProperty('--color-red-light', `var(--color-${color}-light)`)
        root.style.setProperty('--color-red-lighter', `var(--color-${color}-lighter)`)
        root.style.setProperty('--color-red-dark', `var(--color-${color}-dark)`)
        root.style.setProperty('--color-red-darker', `var(--color-${color}-darker)`)
        this.selectedColor = color
        window.localStorage.setItem('color', color)
    }

    return {
        loading: true,
        isDark: getTheme(),
        color: getColor(),
        selectedColor: 'cyan',
        toggleTheme() {
            this.isDark = !this.isDark
            setTheme(this.isDark)
        },
        setLightTheme() {
            this.isDark = false
            setTheme(this.isDark)
        },
        setDarkTheme() {
            this.isDark = true
            setTheme(this.isDark)
        },
        setColors,
        watchScreen() {
            if (window.innerWidth <= 1024) {
                this.isSidebarOpen = false
            } else if (window.innerWidth >= 1024) {
                this.isSidebarOpen = true
            }
        },
        isSidebarOpen: window.innerWidth >= 1024 ? true : false,
        toggleSidbarMenu() {
            this.isSidebarOpen = !this.isSidebarOpen
        },
        isNotificationsPanelOpen: false,
        openNotificationsPanel() {
            this.isNotificationsPanelOpen = true
            this.$nextTick(() => {
                this.$refs.notificationsPanel.focus()
            })
        },
        isViewDetailPanelOpen: false,
        openViewDetailPanel() {
            this.isViewDetailPanelOpen = true
            this.$nextTick(() => {
                this.$refs.settingsPanel.focus()
            })
        },
        isSearchPanelOpen: false,
        openSearchPanel() {
            this.isSearchPanelOpen = true
            this.$nextTick(() => {
                this.$refs.searchInput.focus()
            })
        },
    }
}


document.addEventListener('livewire:init', () => {
    Livewire.on('delete', (event) => {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('confirmDelete', event);
            }
        });
    });
});
