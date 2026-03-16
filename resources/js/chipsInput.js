window.addEventListener('load', function() {
    const chipsInputElements = document.querySelectorAll('.chip-input');

    chipsInputElements.forEach(chipsInputElement => {
        const id = chipsInputElement.id;
        console.log(id);
        initializeChipsInput(id);
    });
})

function initializeChipsInput(id) {
    const chipContainer = document.getElementById('chip-container-'+id);
    const chips = document.getElementById(id).value.split(',').map(chip => chip.trim());
    console.log(id, chips);
    chips.forEach(chip => {
        if (chip === '') {
            return;
        }
        const chipElement = document.createElement('div');
        chipElement.classList.add('badge', 'text-bg-secondary', 'd-flex', 'align-items-center', 'm-1');

        const chipTextContent = document.createElement('span');
        chipTextContent.textContent = chip;
        chipElement.appendChild(chipTextContent);

        const chipCloseButton = document.createElement('button');
        chipCloseButton.type = 'button';
        chipCloseButton.classList.add('btn-close', 'ms-2');
        chipCloseButton.onclick = function() {
            chipContainer.removeChild(chipElement);
            updateChipsInput(id);
        };
        chipElement.appendChild(chipCloseButton);

        chipContainer.appendChild(chipElement);
    });

    // set enter key to add chip
    document.getElementById('chip-input-'+id).addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            addChip(id);
        }
    });

    document.getElementById('chip-button-'+id).addEventListener('click', () => {
        console.log('click');
        addChip(id);
    });
}

function addChip(id) {
    const chipText = document.getElementById('chip-input-'+id).value;
    if (chipText.trim() !== '') {
        const chipContainer = document.getElementById('chip-container-'+id);
        const chip = document.createElement('div');
        chip.classList.add('badge', 'text-bg-secondary', 'd-flex', 'align-items-center', 'm-1');

        const chipTextContent = document.createElement('span');
        chipTextContent.textContent = chipText;
        chip.appendChild(chipTextContent);

        const chipCloseButton = document.createElement('button');
        chipCloseButton.type = 'button';
        chipCloseButton.classList.add('btn-close', 'ms-2');
        chipCloseButton.onclick = function() {
            chipContainer.removeChild(chip);
            updateChipsInput(id);
        };
        chip.appendChild(chipCloseButton);

        chipContainer.appendChild(chip);
        document.getElementById('chip-input-'+id).value = '';
        updateChipsInput(id);
    }
}

function updateChipsInput(id) {
    const chipContainer = document.getElementById('chip-container-'+id);
    const chips = Array.from(chipContainer.querySelectorAll('.badge span')).map(chip => chip.textContent);
    console.log(id, chips.join(', '));
    document.getElementById(id).value = chips.join(', ');
}