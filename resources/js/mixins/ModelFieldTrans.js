export default {
  methods: {
    modelFieldTrans(field) {
      const modelKey = `model.${this.modelSingular}.${field}`
      const modelTranslation = this.$i18n.t(modelKey)

      if (modelTranslation !== modelKey) return modelTranslation

      const key = `model.${field}`
      const keyTranslation = this.$i18n.t(key)

      if (keyTranslation !== key) return keyTranslation

      return field
    },
  },
}
