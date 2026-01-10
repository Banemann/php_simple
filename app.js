// Click-to-edit: toggles contenteditable on post message and shows Save
document.addEventListener('click', (e) => {
	const editBtn = e.target.closest('.post-edit-btn');
	if (!editBtn) return;

	const article = editBtn.closest('article.post');
	if (!article) return;

	const messageEl = article.querySelector('.post-message');
	const saveForm = article.querySelector('.post-edit-save-form');
	if (!messageEl || !saveForm) return;

	// Enable editing
	if (messageEl.getAttribute('contenteditable') !== 'true') {
		messageEl.setAttribute('contenteditable', 'true');
		messageEl.focus();
		editBtn.textContent = 'Save';
		return;
	}

	// Save flow
	const hiddenMessage = saveForm.querySelector('input[name="post_message"]');
	hiddenMessage.value = messageEl.textContent.trim();
	messageEl.setAttribute('contenteditable', 'false');
	editBtn.textContent = 'Edit';
	saveForm.submit();
});
