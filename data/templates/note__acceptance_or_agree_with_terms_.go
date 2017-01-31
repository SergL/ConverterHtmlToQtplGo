

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

         var DataNote__acceptance_or_agree_with_terms_ = DataHtml{
    Inputs: []InputData{
          InputData{ Key: "u478_input", Typeinput: "text", Val: "", Title: "Введите Ваше Фамилию Имя Отчество", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u479_input", Typeinput: "text", Val: "", Title: "Введите серию и номер Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u480_input", Typeinput: "text", Val: "", Title: "Введите название органа, выдавшего паспорт", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u481_input", Typeinput: "text", Val: "", Title: "Введите число выдачи Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u482_input", Typeinput: "text", Val: "", Title: "Введите Место регистрации Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u483_input", Typeinput: "text", Val: "", Title: "Введите Ваше имя", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u503_input", Typeinput: "file", Val: "", Title: "Прикрепите копию Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u504_input", Typeinput: "file", Val: "", Title: "Прикрепите копию Вашего паспорта", Nameinput: "", Placeholder: "",},
    },
    Checkboxs: []CheckboxData{
          CheckboxData{ Key: "u499_input", Typeinput: "checkbox", Val: "checkbox", Name: "",},
    },
}
