// Fix for Alpine.js sidebar store undefined error
document.addEventListener('alpine:init', () => {
    // Initialize sidebar store if not exists
    if (!window.Alpine.store('sidebar')) {
        window.Alpine.store('sidebar', {
            isOpen: window.innerWidth >= 1024, // Default to open on desktop
            
            open() {
                this.isOpen = true;
            },
            
            close() {
                this.isOpen = false;
            },
            
            toggle() {
                this.isOpen = !this.isOpen;
            }
        });
    }
    
    // Initialize theme store if not exists
    if (!window.Alpine.store('theme')) {
        window.Alpine.store('theme', {
            mode: localStorage.getItem('theme') || 'light'
        });
    }
});

// Additional fix for Livewire/Alpine conflicts
document.addEventListener('DOMContentLoaded', () => {
    // Wait for Alpine to be ready
    if (window.Alpine) {
        // Ensure stores are initialized
        if (!window.Alpine.store('sidebar')) {
            window.Alpine.store('sidebar', {
                isOpen: window.innerWidth >= 1024,
                open() { this.isOpen = true; },
                close() { this.isOpen = false; },
                toggle() { this.isOpen = !this.isOpen; }
            });
        }
        
        if (!window.Alpine.store('theme')) {
            window.Alpine.store('theme', {
                mode: localStorage.getItem('theme') || 'light'
            });
        }
    }
});
