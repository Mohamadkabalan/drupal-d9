<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/mri/page.html.twig */
class __TwigTemplate_ad263d7f035a1a9f3b9be326b2214f33117137bb6abefcf6128cdded1f8a7799 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'main' => [$this, 'block_main'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div id=\"wrapper\" >
  <div class=\"mp-pusher\" id=\"mp-pusher\">
    <nav id=\"mp-menu\" class=\"mp-menu\">
      <div class=\"mp-level\">
        <h2>Menu</h2>
        ";
        // line 6
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["mobile_main_menu"] ?? null), 6, $this->source), "html", null, true);
        echo "
        ";
        // line 7
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["mobile_header_menu_left_menu"] ?? null), 7, $this->source), "html", null, true);
        echo "
        ";
        // line 8
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["mobile_header_menu_right_menu"] ?? null), 8, $this->source), "html", null, true);
        echo "
        ";
        // line 9
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["mobile_top_menu_with_icons_menu"] ?? null), 9, $this->source), "html", null, true);
        echo "
      </div>
    </nav>
    <header class=\"section top-nav\">
      ";
        // line 13
        if ((twig_length_filter($this->env, twig_trim_filter(twig_striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_top", [], "any", false, false, true, 13))))) > 0)) {
            // line 14
            echo "        ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_top", [], "any", false, false, true, 14), 14, $this->source), "html", null, true);
            echo "
      ";
        }
        // line 16
        echo "      ";
        if ((twig_length_filter($this->env, twig_trim_filter(twig_striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, true, 16))))) > 0)) {
            // line 17
            echo "        ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, true, 17), 17, $this->source), "html", null, true);
            echo "
      ";
        }
        // line 19
        echo "      ";
        if ((twig_length_filter($this->env, twig_trim_filter(twig_striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_bottom", [], "any", false, false, true, 19))))) > 0)) {
            // line 20
            echo "        ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_bottom", [], "any", false, false, true, 20), 20, $this->source), "html", null, true);
            echo "
      ";
        }
        // line 22
        echo "    </header><!-- section -->

    ";
        // line 24
        $this->displayBlock('main', $context, $blocks);
        // line 49
        echo "    ";
        if ((twig_length_filter($this->env, twig_trim_filter(twig_striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "dashboard_bottom", [], "any", false, false, true, 49))))) > 0)) {
            // line 50
            echo "      ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "dashboard_bottom", [], "any", false, false, true, 50), 50, $this->source), "html", null, true);
            echo "
    ";
        }
        // line 52
        echo "    <div id=\"footer\" class=\"section footer\">
      <div class=\"container\">
        ";
        // line 54
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_left", [], "any", false, false, true, 54), 54, $this->source), "html", null, true);
        echo "
        ";
        // line 55
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_middle", [], "any", false, false, true, 55), 55, $this->source), "html", null, true);
        echo "
        ";
        // line 56
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_right", [], "any", false, false, true, 56), 56, $this->source), "html", null, true);
        echo "
      </div><!-- container -->
    </div><!-- section -->

    <div class=\"copyright\">
      <div id=\"toTop\"><i class=\"fas fa-arrow-up\"></i></div>
      <div class=\"container\">
        ";
        // line 63
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_bottom", [], "any", false, false, true, 63), 63, $this->source), "html", null, true);
        echo "
        <div class=\"copyright-text\">Copyright © ";
        // line 64
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo ". All Rights Reserved.</div>
        <div class=\"siteby\">
          Site by <a href=\"http://www.devvly.com\" target=\"_blank\" title=\"Site by Devvly\">Devvly</a>
        </div><!-- end footer-copy -->
      </div>
    </div>

  </div>
</div><!-- End of wrapper -->
";
    }

    // line 24
    public function block_main($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 25
        echo "    <div class=\"section subpage\">
    ";
        // line 27
        echo "    ";
        // line 28
        echo "          ";
        if ((twig_length_filter($this->env, twig_trim_filter(twig_striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 28))))) > 0)) {
            // line 29
            echo "            <aside id=\"sidebar-first\" class=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebar_first_grid"] ?? null), 29, $this->source), "html", null, true);
            echo " columns sidebar\" role=\"complementary\">
              ";
            // line 30
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 30), 30, $this->source), "html", null, true);
            echo "
            </aside>
          ";
        }
        // line 33
        echo "          <main id=\"main\" class=\"";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["main_grid"] ?? null), 33, $this->source), "html", null, true);
        echo " columns\" role=\"main\">
            <a id=\"main-content\"></a>
            ";
        // line 35
        if (($context["breadcrumb"] ?? null)) {
            echo " ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["breadcrumb"] ?? null), 35, $this->source), "html", null, true);
            echo " ";
        }
        // line 36
        echo "            <section>
              ";
        // line 37
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 37), 37, $this->source), "html", null, true);
        echo "
            </section>
          </main>
          ";
        // line 40
        if ((twig_length_filter($this->env, twig_trim_filter(twig_striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 40))))) > 0)) {
            // line 41
            echo "            <aside id=\"sidebar-second\" class=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebar_sec_grid"] ?? null), 41, $this->source), "html", null, true);
            echo " columns sidebar\" role=\"complementary\">
              ";
            // line 42
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 42), 42, $this->source), "html", null, true);
            echo "
            </aside>
          ";
        }
        // line 45
        echo "    ";
        // line 46
        echo "    ";
        // line 47
        echo "    </div><!-- section -->
    ";
    }

    public function getTemplateName()
    {
        return "themes/mri/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  208 => 47,  206 => 46,  204 => 45,  198 => 42,  193 => 41,  191 => 40,  185 => 37,  182 => 36,  176 => 35,  170 => 33,  164 => 30,  159 => 29,  156 => 28,  154 => 27,  151 => 25,  147 => 24,  133 => 64,  129 => 63,  119 => 56,  115 => 55,  111 => 54,  107 => 52,  101 => 50,  98 => 49,  96 => 24,  92 => 22,  86 => 20,  83 => 19,  77 => 17,  74 => 16,  68 => 14,  66 => 13,  59 => 9,  55 => 8,  51 => 7,  47 => 6,  40 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div id=\"wrapper\" >
  <div class=\"mp-pusher\" id=\"mp-pusher\">
    <nav id=\"mp-menu\" class=\"mp-menu\">
      <div class=\"mp-level\">
        <h2>Menu</h2>
        {{ mobile_main_menu }}
        {{ mobile_header_menu_left_menu }}
        {{ mobile_header_menu_right_menu }}
        {{ mobile_top_menu_with_icons_menu }}
      </div>
    </nav>
    <header class=\"section top-nav\">
      {% if page.header_top|render|striptags|trim|length > 0%}
        {{ page.header_top }}
      {% endif %}
      {% if page.header|render|striptags|trim|length > 0%}
        {{ page.header }}
      {% endif %}
      {% if page.header_bottom|render|striptags|trim|length > 0%}
        {{ page.header_bottom }}
      {% endif %}
    </header><!-- section -->

    {% block main %}
    <div class=\"section subpage\">
    {#  <div class=\"container\">#}
    {#    <div class=\"row\">#}
          {% if page.sidebar_first|render|striptags|trim|length > 0%}
            <aside id=\"sidebar-first\" class=\"{{ sidebar_first_grid }} columns sidebar\" role=\"complementary\">
              {{ page.sidebar_first }}
            </aside>
          {% endif %}
          <main id=\"main\" class=\"{{ main_grid }} columns\" role=\"main\">
            <a id=\"main-content\"></a>
            {% if breadcrumb %} {{ breadcrumb }} {% endif %}
            <section>
              {{ page.content }}
            </section>
          </main>
          {% if page.sidebar_second|render|striptags|trim|length > 0 %}
            <aside id=\"sidebar-second\" class=\"{{ sidebar_sec_grid }} columns sidebar\" role=\"complementary\">
              {{ page.sidebar_second }}
            </aside>
          {% endif %}
    {#    </div>#}
    {#  </div><!-- container -->#}
    </div><!-- section -->
    {% endblock %}
    {% if page.dashboard_bottom|render|striptags|trim|length > 0%}
      {{ page.dashboard_bottom }}
    {% endif %}
    <div id=\"footer\" class=\"section footer\">
      <div class=\"container\">
        {{ page.footer_left }}
        {{ page.footer_middle }}
        {{ page.footer_right }}
      </div><!-- container -->
    </div><!-- section -->

    <div class=\"copyright\">
      <div id=\"toTop\"><i class=\"fas fa-arrow-up\"></i></div>
      <div class=\"container\">
        {{ page.footer_bottom }}
        <div class=\"copyright-text\">Copyright © {{ 'now'|date('Y') }}. All Rights Reserved.</div>
        <div class=\"siteby\">
          Site by <a href=\"http://www.devvly.com\" target=\"_blank\" title=\"Site by Devvly\">Devvly</a>
        </div><!-- end footer-copy -->
      </div>
    </div>

  </div>
</div><!-- End of wrapper -->
", "themes/mri/page.html.twig", "C:\\xampp\\htdocs\\drupal\\web\\themes\\mri\\page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 13, "block" => 24);
        static $filters = array("escape" => 6, "length" => 13, "trim" => 13, "striptags" => 13, "render" => 13, "date" => 64);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'block'],
                ['escape', 'length', 'trim', 'striptags', 'render', 'date'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
