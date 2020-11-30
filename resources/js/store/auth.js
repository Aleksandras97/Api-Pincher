import axios from 'axios'

const state = {
    token: null,
    user: null,
    following: [],
    posts: [],
}
//localStorage.getItem('access_token') ||

const getters = {
    authenticated(state) {
        return state.token  != null
    },
    authUser(state) {
        return state.user
    },
    followingUsers(state) {
        return state.following
    },
    timeline(state) {
      return state.posts
    }
}

const mutations = {
    SET_TOKEN(state, token) {
        state.token = token
    },
    SET_USER(state, data) {
        state.user = data
    },
    SET_FOLLOWING(state, data){

        state.following = data
    },
    SET_FOLLOW(state, data){

        if (data.isFollowing) {
            state.following.push(data.user)
        } else {
            let index = state.following.map(item => item.id).indexOf(data.user.id)
            state.following.splice(index, 1)
        }

    },
    SET_TIMELINE(state, data){
      state.posts = data
    },
    SET_ADDPOST(state ,data) {
      state.posts.unshift(data)
    },
    SET_DELETEPOST(state , index) {
      state.posts.splice(index, 1)
    },

}

const actions = {

    async signIn ({ dispatch }, credentials) {
        let response = await axios.post('api/login', {
            username: credentials.username,
            password: credentials.password,
        })

        return dispatch('attempt', response.data.access_token)
    },

    async attempt ({ commit, state, dispatch }, token) {
        if(token) {
            commit('SET_TOKEN', token)
        }

        if(!state.token){
            return
        }

        try {
            let response = await axios.get(`/api/logedinUser`)

            commit('SET_USER', response.data.data)
            dispatch('following')
            dispatch('timeline')
        } catch (error) {
            console.log('failed', error)
            commit('SET_TOKEN', null)
            commit('SET_USER', null)
        }
    },

    async timeline({commit}) {
      await axios.get('api/timeline')
      .then(response => {
          commit('SET_TIMELINE', response.data.data)
      })
      .catch(err => {
          console.log(err)
      })
    },

    async addPost({commit}, post) {
      let response = await axios.post('api/posts', { body: post })
      commit('SET_ADDPOST', response.data.data)
    },

    async deletePost({commit}, post) {
      await axios.delete(`api/posts/${post.PostId}`)
      commit('SET_DELETEPOST', post.PostIndex)
    },

    async following ({commit}) {
        let response = await axios.get('api/following')
        commit('SET_FOLLOWING', response.data.data)
    },

    async follow ({commit}, user) {
        let response = await axios.post(`api/profiles/${user}/follow`)
        commit('SET_FOLLOW', response.data)
    },

    async editProfile ({commit}, user) {
      const formData = new FormData
      formData.append('username', user.username)
      formData.append('name', user.name)
      formData.append('email', user.email)
      formData.append('password', user.password)
      formData.append('password_confirmation', user.confirm)
      formData.append('avatar', user.avatar)
      formData.append('_method', 'patch')

      let response = await axios.post(`api/profiles/${user.authUser}`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      })

      commit('SET_USER', response.data.data)
    },

    register(context, data) {

        return new Promise((resolve, reject) => {
            axios.post('api/register', {
                username: data.username,
                name: data.name,
                email: data.email,
                password: data.password,
            })
                .then(response =>  {

                  resolve(response)
                })
                .catch(error => {
                  reject(error)
                })
        })

    },

    signOut({ commit }){

        return axios.post('api/logout').then(() =>  {

            commit('SET_TOKEN', null)
            commit('SET_USER', null)
            commit('SET_FOLLOWING', null)
            commit('SET_TIMELINE', null)
        })
    }

}

export const AuthModule = ({
    state,
    getters,
    mutations,
    actions
})
