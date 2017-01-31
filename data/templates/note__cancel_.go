

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

         var DataNote__cancel_ = DataHtml{
    Inputs: []InputData{
          InputData{ Key: "u348_input", Typeinput: "text", Val: "", Title: "Введите Ваше Фамилию Имя Отчество", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u349_input", Typeinput: "text", Val: "", Title: "Введите серию и номер Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u350_input", Typeinput: "text", Val: "", Title: "Введите название органа, выдавшего паспорт", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u351_input", Typeinput: "text", Val: "", Title: "Введите число выдачи Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u352_input", Typeinput: "text", Val: "", Title: "Введите Место регистрации Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u353_input", Typeinput: "text", Val: "", Title: "Введите Ваше имя", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u373_input", Typeinput: "file", Val: "", Title: "Прикрепите копию Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u374_input", Typeinput: "file", Val: "", Title: "Прикрепите копию Вашего паспорта", Nameinput: "", Placeholder: "",},
    },
    Checkboxs: []CheckboxData{
          CheckboxData{ Key: "u369_input", Typeinput: "checkbox", Val: "checkbox", Name: "",},
    },
}
