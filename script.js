const taskInput = document.querySelector("#taskInput");
const addBtn = document.querySelector("#addBtn");
const taskList = document.querySelector("#taskList");
const remainingCount = document.querySelector("#remainingCount");
const filterButtons = document.querySelectorAll(".filter");
const clearCompleted = document.querySelector("#clearCompleted");

let currentFilter = "all";

function createTask(text) {
    const li = document.createElement("li");
    li.className = "task-item";

    li.innerHTML = `
        <button class="done-btn">✓</button>
        <span>${text}</span>
        <button class="delete-btn">Delete</button>
    `;

    taskList.appendChild(li);
}

function addTask() {
    const text = taskInput.value.trim();

    if (text === "") {
        taskInput.focus();
        return;
    }

    createTask(text);
    taskInput.value = "";
    taskInput.focus();

    updateTasks();
}

function updateTasks() {
    const tasks = document.querySelectorAll(".task-item");
    let remaining = 0;
    let visibleCount = 0;

    tasks.forEach(task => {
        const isCompleted = task.classList.contains("completed");

        if (!isCompleted) {
            remaining++;
        }

        if (currentFilter === "all") {
            task.style.display = "flex";
            visibleCount++;
        } else if (currentFilter === "active" && !isCompleted) {
            task.style.display = "flex";
            visibleCount++;
        } else if (currentFilter === "completed" && isCompleted) {
            task.style.display = "flex";
            visibleCount++;
        } else {
            task.style.display = "none";
        }
    });

    remainingCount.textContent = remaining;

    const oldEmpty = document.querySelector(".empty");
    if (oldEmpty) {
        oldEmpty.remove();
    }

    if (tasks.length === 0 || visibleCount === 0) {
        const message = document.createElement("p");
        message.className = "empty";
        message.textContent = "No tasks to show";
        taskList.appendChild(message);
    }
}

addBtn.addEventListener("click", addTask);

taskInput.addEventListener("keydown", event => {
    if (event.key === "Enter") {
        addTask();
    }
});

taskList.addEventListener("click", event => {
    if (event.target.classList.contains("done-btn")) {
        const task = event.target.closest(".task-item");
        task.classList.toggle("completed");
        updateTasks();
    }

    if (event.target.classList.contains("delete-btn")) {
        const task = event.target.closest(".task-item");
        task.remove();
        updateTasks();
    }
});

filterButtons.forEach(button => {
    button.addEventListener("click", () => {
        filterButtons.forEach(btn => btn.classList.remove("active"));
        button.classList.add("active");
        currentFilter = button.dataset.filter;
        updateTasks();
    });
});

clearCompleted.addEventListener("click", () => {
    const completedTasks = document.querySelectorAll(".task-item.completed");

    completedTasks.forEach(task => {
        task.remove();
    });

    updateTasks();
});

updateTasks();