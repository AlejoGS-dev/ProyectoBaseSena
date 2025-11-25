function addPost(postData) {
    const template = document.getElementById('post-template');
    const clone = template.content.cloneNode(true);

    clone.querySelector('.avatar img').src = postData.avatar;
    clone.querySelector('.avatar img').alt = postData.userName;
    clone.querySelector('.user-name').textContent = postData.userName;
    clone.querySelector('.timestamp').textContent = postData.timestamp;
    clone.querySelector('.post-content p').textContent = postData.content;

    const postImage = clone.querySelector('.post-image img');
    if(postData.image) {
        postImage.src = postData.image;
        postImage.style.display = 'block';
    } else {
        postImage.style.display = 'none';
    }

    clone.querySelector('.like-count').textContent = postData.likes || 0;

    document.getElementById('feed').prepend(clone);
}

document.getElementById('publish-btn').addEventListener('click', async () => {
    const content = document.getElementById('post-text').value;
    const imageInput = document.getElementById('post-image');
    const image = imageInput.files[0];

    const formData = new FormData();
    formData.append('content', content);
    if(image) formData.append('image', image);

    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
        const res = await fetch('/posts', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            body: formData
        });

        const postData = await res.json();
        addPost(postData);

        document.getElementById('post-text').value = '';
        imageInput.value = '';
    } catch(err) {
        console.error(err);
        alert('Error al publicar');
    }
});
