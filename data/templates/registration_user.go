

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

         var DataRegistration_user = DataHtml{
    Inputs: []InputData{
          InputData{ Key: "u4475_input", Typeinput: "text", Val: "", Title: "Введите Ваше имя", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4476_input", Typeinput: "email", Val: "", Title: "Введите Ваш email", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4477_input", Typeinput: "tel", Val: "", Title: "Введите Ваш контактный номер", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4478_input", Typeinput: "password", Val: "", Title: "Введите Ваш пароль", Nameinput: "", Placeholder: "",},
    },
    Checkboxs: []CheckboxData{
          CheckboxData{ Key: "u4479_input", Typeinput: "checkbox", Val: "checkbox", Name: "",},
    },
}
