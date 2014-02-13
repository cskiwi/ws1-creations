<?php

/* index.tpl */
class __TwigTemplate_3ee05262d43c7ce80959851f6983bd682d38a080658e2a71b6b814e178966d11 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layout.tpl");

        $this->blocks = array(
            'pageContent' => array($this, 'block_pageContent'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.tpl";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["pageTitle"] = "Contacten overzicht";
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 6
    public function block_pageContent($context, array $blocks = array())
    {
        // line 7
        echo "    <div id=\"filters\">
        <dl>
            <dt><label>Toon: </label></dt>
            <dd id=\"filterLinks\">
                <a href=\"index.php?filter=all\" id=\"lnkAll\" class=\"active\" data-filter=\"contact\">iedereen</a> (<span id=\"numAll\">11</span>) &ndash;
                <a href=\"index.php?filter=family\" id=\"lnkFamily\" data-filter=\"family\">familie</a> (<span id=\"numFamily\">1</span>) &ndash;
                <a href=\"index.php?filter=friend\" id=\"lnkFriends\" data-filter=\"friend\">vrienden</a> (<span id=\"numFriends\">4</span>) &ndash;
                <a href=\"index.php?filter=colleague\" id=\"lnkColleagues\" data-filter=\"colleague\">collega's</a> (<span id=\"numColleagues\">3</span>) &ndash;
                <a href=\"index.php?filter=other\" id=\"lnkOther\" data-filter=\"other\">andere</a> (<span id=\"numOther\">3</span>)
            </dd>
        </dl>
    </div>
    <div id=\"content\" class=\"clearfix\">
        <div class=\"add\">
            + <a href=\"add.php\">nieuw contact</a>&hellip;
        </div>

        <section id=\"contacts\">
            ";
        // line 26
        echo "            ";
        if ((isset($context["contacts"]) ? $context["contacts"] : null)) {
            // line 27
            echo "                ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["contacts"]) ? $context["contacts"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["contact"]) {
                // line 28
                echo "                    <article class=\"contact friend clearfix\" id=\"contact_";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "id"), "html", null, true);
                echo "\"  data-search=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "name"), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "email"), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "comments"), "html", null, true);
                echo "\">
                        <h1>";
                // line 29
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "name"), "html", null, true);
                echo "</h1>
                        <a href=\"#\"><img src=\"files/avatars/avatar_";
                // line 30
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "id"), "html", null, true);
                echo ".jpg\" alt=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "name"), "html", null, true);
                echo "\" class=\"thumb\"></a>
                        <ul class=\"menu\">
                            <li>&gt; <a href=\"edit.php?id=";
                // line 32
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "id"), "html", null, true);
                echo "\" class=\"edit\" data-id=\"30\">bewerken</a>&hellip;</li>
                            <li>&gt; <a href=\"delete.php?id=";
                // line 33
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "id"), "html", null, true);
                echo "\" class=\"delete\" data-id=\"30\">verwijderen</a>&hellip;</li>
                        </ul>
                        <p class=\"toolbar\">
                            ";
                // line 36
                if ($this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "comments")) {
                    // line 37
                    echo "                                <a href=\"#\" class=\"comments tooltip\"><img src=\"img/icons/info.gif\" alt=\"icon comments\"><span>";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "comments"), "html", null, true);
                    echo "</span></a>
                            ";
                }
                // line 39
                echo "                            <a href=\"mailto:";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "email"), "html", null, true);
                echo "\" title=\"email versturen\" class=\"lnkmail\"><img src=\"img/icons/mail.png\" alt=\"icon mail\"></a>
                        </p>
                    </article>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['contact'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 43
            echo "            ";
        } else {
            // line 44
            echo "                <li>No contacts to show</li>

            ";
        }
        // line 47
        echo "        </section>
    </div>
";
    }

    public function getTemplateName()
    {
        return "index.tpl";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  120 => 47,  115 => 44,  112 => 43,  101 => 39,  95 => 37,  93 => 36,  87 => 33,  83 => 32,  76 => 30,  72 => 29,  61 => 28,  56 => 27,  53 => 26,  33 => 7,  30 => 6,  25 => 3,);
    }
}
