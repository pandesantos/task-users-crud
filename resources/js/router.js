import { createMemoryHistory, createRouter } from 'vue-router'
import List from "./Components/User/List.vue";
import Create from "./Components/User/Create.vue";
import Edit from "./Components/User/Edit.vue";


const routes = [
    { path: '/', component: List },
    { path: '/create-user', component: Create },
    { path: '/edit-user/:id', component: Edit },
]

const router = createRouter({
    history: createMemoryHistory(),
    routes,
})

export default router