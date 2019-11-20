package model;

public class Aluno implements mvc.Model {
    private String aluno, numero, turma;

    public String getAluno() {
        return aluno;
    }

    public void setAluno(String aluno) {
        this.aluno = aluno;
    }

    public String getNumero() {
        return numero;
    }

    public void setNumero(String numero) {
        this.numero = numero;
    }

    public String getTurma() {
        return turma;
    }

    public void setTurma(String turma) {
        this.turma = turma;
    }

    public Aluno(String aluno, String numero, String turma) {
        this.aluno = aluno;
        this.numero = numero;
        this.turma = turma;
    }
}
