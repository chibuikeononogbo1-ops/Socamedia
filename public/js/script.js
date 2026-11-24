// Mock Data
const currentUser = {
    id: 1,
    name: "Fests Code",
    username: "@festuscode",
    avatar: "https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
    bio: "Full Stack Developer 🚀 | Coffee Enthusiast ☕ | Building cool things",
    posts: 43,
    followers: 1225,
    following: 450
};

const posts = [
    {
        id: 1,
        user: {
            name: "Sarah Design",
            username: "@sarah_d",
            avatar: "https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
        },
        image: "https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80",
        caption: "Working on a new dashboard design! 🎨 What do you think?",
        likes: 124,
        comments: [
            { user: "John Doe", text: "Looks amazing! 🔥" },
            { user: "Jane Smith", text: "Love the color palette!" }
        ],
        time: "2 hours ago"
    },
    {
        id: 2,
        user: {
            name: "Alex Dev",
            username: "@alex_code",
            avatar: "https://images.unsplash.com/photo-1527980965255-d3b416303d12?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
        },
        image: "https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80",
        caption: "Late night coding session. 💻 #developer #coding",
        likes: 89,
        comments: [],
        time: "5 hours ago"
    }
];

// DOM Elements & Event Listeners
document.addEventListener('DOMContentLoaded', () => {
    // Determine current page
    const path = window.location.pathname;
     if (path.includes('profile.html')) {
        renderProfile();
    }
    
    // Global Listeners
    setupImagePreviews();
});



// Interaction Functions
function toggleLike(btn) {
    const icon = btn.querySelector('i');
    const postId = btn.attributes['data-id'].value
    if (btn.classList.contains('liked')) {
        btn.classList.remove('liked');
        icon.className = 'ri-heart-line';
        btn.innerHTML = `<i class="ri-heart-line"></i> ${parseInt(btn.innerText) - 1}`;
        ///fetch to do something in db
    } else {
        btn.classList.add('liked');
        icon.className = 'ri-heart-fill';
        btn.innerHTML = `<i class="ri-heart-fill"></i> ${parseInt(btn.innerText) + 1}`;
    }

    /// post request for likes
        async function likePost() {
        const response = await fetch('http://127.0.0.1:8000/likes/create',{
            method: 'post',
            headers:{
                'Content-Type' : 'application/json'
            },
            body: JSON.stringify({
                
                'post_id':postId,
            })
        })

        if(!response.ok){
            throw new Error('HTTP error! status: '+ response.status);
        }

        const result = await response.json();
        // console.log('success');
        // console.log(result);
        
        
        
     }

     likePost()

}

function addComment(btn) {
    const input = btn.previousElementSibling;
    const text = input.value;
    const postId = input.attributes['data-id'].value
    const commentCount = document.querySelector('.comment-count-'+postId);
    if (!text.trim()) return;
    
    const commentSection = btn.parentElement.parentElement;
    const newComment = document.createElement('div');
    newComment.style.cssText = 'font-size: 14px; margin-bottom: 5px;';
    newComment.innerHTML = `<span style="font-weight: 600;">You</span> <span style="color: var(--text-muted);">${text}</span>`;
    
    commentSection.insertBefore(newComment, btn.parentElement);
    input.value = '';

    //increment coometcount
    commentCount.textContent = Number(commentCount.textContent) + 1 ;
     ///fetch to do something in db

     async function commentPost() {
        const response = await fetch('http://127.0.0.1:8000/comments/create',{
            method: 'post',
            headers:{
                'Content-Type' : 'application/json'
            },
            body: JSON.stringify({
                'body':text,
                'post_id':postId,
            })
        })

        if(!response.ok){
            throw new Error('HTTP error! status: '+ response.status);
        }

        const result = await response.json();
        // console.log('success');
        // console.log(result);
        
        
        
     }

     commentPost();

}

function followUser(btn) {
    const suggestedUserId = btn.attributes['data-id'].value
    if (btn.innerText === "Follow") {
        btn.innerText = "Following";
        btn.style.background = "var(--primary-color)";
        btn.style.color = "#fff";
        btn.style.borderColor = "transparent";


    } else {
        btn.innerText = "Follow";
        btn.style.background = "transparent";
        btn.style.color = "var(--text-main)";
        btn.style.borderColor = "var(--border-color)";
    }

       /// post request for likes
        async function follow() {
        const response = await fetch('http://127.0.0.1:8000/follow/create',{
            method: 'post',
            headers:{
                'Content-Type' : 'application/json'
            },
            body: JSON.stringify({
                
                'suggesteduser_id':suggestedUserId,
            })
        })

        if(!response.ok){
            throw new Error('HTTP error! status: '+ response.status);
        }

        const result = await response.json();
        console.log('success');
        console.log(result);
        
        
        
     }

     follow();

}

// Image File Preview
function setupImagePreviews() {
    const fileInput = document.getElementById('file-upload');
    const preview = document.getElementById('image-preview');
    
    if (fileInput && preview) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    }
}

// Mock Render Profile for Profile Page
function renderProfile() {
    // Populate header info
    document.querySelector('.profile-info h1').innerText = currentUser.name;
    document.querySelector('.profile-handle').innerText = currentUser.username;
    
    // Create mock posts grid
    const grid = document.querySelector('.profile-grid');
    if (grid) {
        // Just duplicating the mock posts for grid visual
        [...posts, ...posts, ...posts].forEach(post => {
            const div = document.createElement('div');
            div.className = 'grid-post';
            div.innerHTML = `
                <img src="${post.image}" alt="Post">
                <div class="grid-overlay">
                    <span><i class="ri-heart-fill"></i> ${post.likes}</span>
                    <span><i class="ri-chat-3-fill"></i> ${post.comments.length}</span>
                </div>
            `;
            grid.appendChild(div);
        });
    }
}
