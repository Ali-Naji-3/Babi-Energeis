/**
 * BabiEnergies - Enhanced Drag and Drop File Upload
 * Professional drag and drop functionality with visual feedback
 */

document.addEventListener('DOMContentLoaded', function() {
    // Enhanced drag and drop for all file upload components
    const fileUploadComponents = document.querySelectorAll('[data-filament-file-upload]');
    
    fileUploadComponents.forEach(component => {
        enhanceDragAndDrop(component);
    });
});

function enhanceDragAndDrop(component) {
    const dropZone = component.querySelector('[data-filament-file-upload-zone]') || component;
    
    if (!dropZone) return;
    
    // Add visual feedback classes
    dropZone.classList.add('filament-file-upload-zone');
    
    // Drag enter event
    dropZone.addEventListener('dragenter', function(e) {
        e.preventDefault();
        e.stopPropagation();
        dropZone.classList.add('dragover');
        addDragOverlay(dropZone);
    });
    
    // Drag over event
    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        dropZone.classList.add('dragover');
    });
    
    // Drag leave event
    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        // Only remove dragover if leaving the drop zone entirely
        if (!dropZone.contains(e.relatedTarget)) {
            dropZone.classList.remove('dragover');
            removeDragOverlay(dropZone);
        }
    });
    
    // Drop event
    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        e.stopPropagation();
        dropZone.classList.remove('dragover');
        removeDragOverlay(dropZone);
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            handleFileDrop(files, dropZone);
        }
    });
    
    // Click to upload enhancement
    dropZone.addEventListener('click', function(e) {
        if (e.target.closest('[data-filament-file-upload-remove]')) {
            return; // Don't trigger file input on remove button
        }
        
        const fileInput = component.querySelector('input[type="file"]');
        if (fileInput) {
            fileInput.click();
        }
    });
}

function addDragOverlay(dropZone) {
    // Remove existing overlay
    removeDragOverlay(dropZone);
    
    const overlay = document.createElement('div');
    overlay.className = 'drag-overlay';
    overlay.innerHTML = `
        <div style="
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(34, 197, 94, 0.05) 100%);
            border: 2px dashed #22c55e;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            animation: dragPulse 0.6s ease-in-out;
        ">
            <div style="
                text-align: center;
                color: #22c55e;
                font-weight: 600;
                font-size: 1.125rem;
            ">
                <div style="font-size: 3rem; margin-bottom: 1rem;">📁</div>
                <div>Drop files here to upload</div>
            </div>
        </div>
    `;
    
    dropZone.style.position = 'relative';
    dropZone.appendChild(overlay);
}

function removeDragOverlay(dropZone) {
    const overlay = dropZone.querySelector('.drag-overlay');
    if (overlay) {
        overlay.remove();
    }
}

function handleFileDrop(files, dropZone) {
    const fileInput = dropZone.closest('[data-filament-file-upload]').querySelector('input[type="file"]');
    
    if (fileInput) {
        // Create a new FileList with the dropped files
        const dataTransfer = new DataTransfer();
        Array.from(files).forEach(file => {
            dataTransfer.items.add(file);
        });
        fileInput.files = dataTransfer.files;
        
        // Trigger change event to notify Filament
        const changeEvent = new Event('change', { bubbles: true });
        fileInput.dispatchEvent(changeEvent);
        
        // Show success feedback
        showUploadFeedback(dropZone, 'Files added successfully!', 'success');
    }
}

function showUploadFeedback(dropZone, message, type = 'success') {
    const feedback = document.createElement('div');
    feedback.className = `upload-feedback ${type}`;
    feedback.innerHTML = `
        <div style="
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: ${type === 'success' ? 'linear-gradient(135deg, #22c55e 0%, #16a34a 100%)' : 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)'};
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 20;
            animation: slideInRight 0.3s ease-out;
        ">
            ${message}
        </div>
    `;
    
    dropZone.style.position = 'relative';
    dropZone.appendChild(feedback);
    
    // Remove feedback after 3 seconds
    setTimeout(() => {
        if (feedback.parentNode) {
            feedback.style.animation = 'slideOutRight 0.3s ease-in';
            setTimeout(() => {
                feedback.remove();
            }, 300);
        }
    }, 3000);
}

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    @keyframes dragPulse {
        0% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4);
        }
        70% {
            transform: scale(1.05);
            box-shadow: 0 0 0 10px rgba(34, 197, 94, 0);
        }
        100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0);
        }
    }
    
    .upload-feedback {
        animation: slideInRight 0.3s ease-out;
    }
    
    .filament-file-upload.dragover {
        animation: dragPulse 0.6s ease-in-out !important;
    }
`;
document.head.appendChild(style);

// Export functions for global use
window.BabiEnergiesDragDrop = {
    enhanceDragAndDrop,
    showUploadFeedback,
    handleFileDrop
};
