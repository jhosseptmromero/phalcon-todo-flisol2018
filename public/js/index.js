window.onload = function () {

    // Full spec-compliant TodoMVC with localStorage persistence
    // and hash-based routing in ~120 effective lines of JavaScript.

    // localStorage persistence
    var STORAGE_KEY = 'todos-vuejs-2.0';

    var serverPath = 'http://localhost/flisol-todo/';
    var todoStorage = {
        fetch: function () {
            var todos = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]')
            todos.forEach(function (todo, index) {
                todo.id = index
            })
            todoStorage.uid = todos.length
            return todos
        },
        save: function (todos) {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(todos))
        }
    }

    // visibility filters
    var filters = {
        all: function (todos) {
            return todos
        },
        active: function (todos) {
            return todos.filter(function (todo) {
                return !todo.completed
            })
        },
        completed: function (todos) {
            return todos.filter(function (todo) {
                return todo.completed
            })
        }
    }


    // app Vue instance
    var app = new Vue({
        // app initial state
        data: {
            todos: [],
            newTodo: '',
            editedTodo: null,
            visibility: 'all'
        },
        // watch todos change for localStorage persistence
        watch: {
            todos: {
                handler: function (todos) {
                    todoStorage.save(todos)
                },
                deep: true
            }
        },

        // computed properties
        // http://vuejs.org/guide/computed.html
        computed: {
            filteredTodos: function () {
                return filters[this.visibility](this.todos)
            },
            remaining: function () {
                return filters.active(this.todos).length
            },
            allDone: {
                get: function () {
                    return this.remaining === 0
                },
                set: function (value) {
                    this.todos.forEach(function (todo) {
                        todo.completed = value;
                    });
                    var context= this;
                    this.todos.forEach(function (todo) {
                        context.save(todo);
                    })
                }
            }
        },

        filters: {
            pluralize: function (n) {
                return n === 1 ? 'item' : 'items'
            }
        },


        created: function () {
            this.initData();
        },

        // methods that implement data logic.
        // note there's no DOM manipulation here at all.
        methods: {
            initData: function () {
                this.$http.get(serverPath + "todos").then(function (response) {
                    this.todos = response.data.map(function (todo) {
                        todo.completed = todo.completed == 1;
                        return todo;
                    });
                });
            },
            save: function (todo) {
                this.$http.post(serverPath + "todos/" + (typeof todo.id === "undefined" ? "save" : "edit"), todo).then(function (response) {
                    if (typeof response.data.status === "undefined" && typeof todo.id === "undefined")
                        this.todos.push(response.data);
                });
            },
            remove: function (todo) {
                return this.$http.get(serverPath + "todos/remove/" + todo.id);
            },
            addTodo: function () {
                var value = this.newTodo && this.newTodo.trim()
                if (!value) {
                    return
                }
                this.save({
                    title: value,
                    completed: false
                });

                this.newTodo = ''
            },

            removeTodo: function (todo) {
                this.remove(todo)
                this.todos.splice(this.todos.indexOf(todo), 1)

            },

            editTodo: function (todo) {
                this.beforeEditCache = todo.title;
                this.editedTodo = todo
            },

            doneEdit: function (todo) {
                if (!this.editedTodo) {
                    return
                }
                this.editedTodo = null;
                todo.title = todo.title.trim();

                this.save(todo);


                if (!todo.title) {
                    this.removeTodo(todo)
                }
            },

            cancelEdit: function (todo) {
                this.editedTodo = null
                todo.title = this.beforeEditCache
            },

            removeCompleted: function () {
                this.todos = filters.active(this.todos)
            }
        },

        // a custom directive to wait for the DOM to be updated
        // before focusing on the input field.
        // http://vuejs.org/guide/custom-directive.html
        directives: {
            'todo-focus': function (el, binding) {
                if (binding.value) {
                    el.focus()
                }
            }
        }
    })

    // handle routing
    function onHashChange() {
        var visibility = window.location.hash.replace(/#\/?/, '')
        if (filters[visibility]) {
            app.visibility = visibility
        } else {
            window.location.hash = ''
            app.visibility = 'all'
        }
    }

    window.addEventListener('hashchange', onHashChange)
    onHashChange()

    // mount
    app.$mount('.todoapp')
}