import { getUserProfile } from '../services/userService'

const state = {
  profile: {}
}

const mutations = {
  SET_PROFILE(state, profile) {
    state.profile = profile
  }
}

const actions = {
  async fetchProfile({ commit }) {
    try {
      const profile = await getUserProfile()
      commit('SET_PROFILE', profile)
    } catch (error) {
      console.error('Failed to fetch profile:', error.message)
    }
  }
}

const getters = {
  userProfile: (state) => state.profile
}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}