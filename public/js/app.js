document.addEventListener('DOMContentLoaded', () => {
    const nextButton = document.getElementById('next');
    const pages = document.querySelectorAll('.page');
    let currentPage = 0;

    if (nextButton) {
        nextButton.addEventListener('click', () => {
            pages[currentPage].classList.add('hidden');
            currentPage += 1;
            pages[currentPage].classList.remove('hidden');
        });
    }

    const categoryDropdown = document.getElementById('category');
    const addButton = document.getElementById('add-button');

    if (categoryDropdown) {
        categoryDropdown.addEventListener('change', () => {
            if (categoryDropdown.value === '3') {
                addButton.textContent = 'Add Savings';
            } else {
                addButton.textContent = 'Add Expense';
            }
        });
    }

});

