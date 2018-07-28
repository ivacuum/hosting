import ModelProvide from '../../../mixins/ModelProvide'
import ModelFieldTrans from '../../../mixins/ModelFieldTrans'

const model = 'Issue'

export default {
  mixins: [ModelFieldTrans, ModelProvide],

  data() {
    return {
      modelPlural: window.singularAndPluralForms[model].plural,
      modelSingular: window.singularAndPluralForms[model].singular,
    }
  },
}
