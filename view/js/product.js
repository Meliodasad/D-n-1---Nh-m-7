
document.querySelectorAll('.section-header').forEach(header => {
    header.addEventListener('click', function () {
        const content = this.nextElementSibling;
        const arrow = this.querySelector('.arrow');
        
        content.style.display = content.style.display === 'block' ? 'none' : 'block';
        arrow.style.transform = content.style.display === 'block' ? 'rotate(180deg)' : 'rotate(0deg)';
    });
});
