

//{% code
    type InputData struct {
        Key         string;
        Nameinput   string;
        Typeinput   string;
        Title       string;
        Val         string;
        Placeholder string;
    }
                    
    type TextareaData struct {
        Key         string;
        Name        string;
        Typeinput   string;
        Title       string;
        Val       string;
        Placeholder string;
    }

    type CheckboxData struct {
        Name        string;
        Key         string;
        Typeinput   string;
        Val         string;
        Title       string;
        Idx         int; 
        Checked     string;
        Events      string; 
        DataJson    string;
    }
    
    type DataHtml struct{
        Checkboxs   []CheckboxData;
        Inputs      []InputData;
        Textareas   []TextareaData;
    }
//%}



           package templates

         var DataState_new_user__onboarding_ = DataHtml{
    Checkboxs: []CheckboxData{
          CheckboxData{ Key: "u4608_input", Typeinput: "checkbox", Val: "checkbox", Name: "",},
          CheckboxData{ Key: "u4610_input", Typeinput: "checkbox", Val: "checkbox", Name: "",},
          CheckboxData{ Key: "u4612_input", Typeinput: "checkbox", Val: "checkbox", Name: "",},
          CheckboxData{ Key: "u4614_input", Typeinput: "checkbox", Val: "checkbox", Name: "",},
          CheckboxData{ Key: "u4616_input", Typeinput: "checkbox", Val: "checkbox", Name: "",},
          CheckboxData{ Key: "u4618_input", Typeinput: "checkbox", Val: "checkbox", Name: "",},
          CheckboxData{ Key: "u4620_input", Typeinput: "checkbox", Val: "checkbox", Name: "",},
          CheckboxData{ Key: "u4622_input", Typeinput: "checkbox", Val: "checkbox", Name: "",},
    },
    Inputs: []InputData{
          InputData{ Key: "u5098_input", Typeinput: "text", Val: "&nbsp;краткое название объекта для экстранета", Nameinput: "", Title: "", Placeholder: "",},
          InputData{ Key: "u5099_input", Typeinput: "submit", Val: "Отмена", Nameinput: "", Title: "", Placeholder: "",},
          InputData{ Key: "u5100_input", Typeinput: "submit", Val: "Добавить", Nameinput: "", Title: "", Placeholder: "",},
    },
}
